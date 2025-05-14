<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\LevelCategory;
use App\Models\LevelSubject;
use App\Models\Subject;
use App\Models\SubjectGrade;
use App\Models\TestExamMarks;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use function redirect;
use function response;
use function view;

class SubjectController extends Controller
{
    public function __construct() {
        $this->middleware(['role_or_permission:create-subject|edit-subject|delete-subject']);
        ## or
        ## $this->middleware(['role:Super-Admin','permission:publish articles|edit articles']);
    }
    public function subjects() {
      Session::put('page','course'); Session::put('subpage','subjects');
      $page_info = ['title'=>'View Subjects ','icon'=>'pe-7s-notebook','sub-title'=>'Below are the list of subjects available'];
       $btns = [
           ['name'=>"Create New Subject",'action'=>"admin/add-edit-subject", 'class'=>'btn btn-success'],
           ['name'=>"Define Subject / Levels ",'action'=>"admin/manage-subject-for-levels", 'class'=>'btn btn-primary']
           ];
        
      $subjects = Subject::get()->toArray();      
      return view('admin.subjects.subjects',compact('page_info','subjects','btns'));   
    }
    
    public function addEditSubject(Request $request, $sid=null) {
       Session::put('page','course'); Session::put('subpage','add_subject');
        if($sid==''){
           $page_info = ['title'=>'Create New Subject ','icon'=>'pe-7s-notebook','sub-title'=>'Below are the list of subjects available'];      
           $subject = new Subject; $message = "Subject Successfully Saved"; 
       }
       else {
           $page_info = ['title'=>'Edit Subject ','icon'=>'pe-7s-notebook','sub-title'=>'Below are the list of subjects available'];      
           $subject = Subject::find($sid); $message = "Subject Successfully Updated"; 
       }
       
       if($request->isMethod('post')){
           $data = $request->all(); 
            $rules = [
                'code'=>"required|string|max:255",
                'title'=>"required|string|max:255"
            ];
            $customMessage = [
               'subject-code.required'=>"Please fill in the subject code", 
               'subject-code.unique'=>"Code already exists", 
               'subject-title.required'=>"Please fill in the subject title"
                ];
             ##$validator = Validator::make($data, $rules,$customMessage);
            
            $this->validate($request, $rules, $customMessage); 
            
            $subject->code = $data['code'];
            $subject->title = $data['title'];
            $subject->save(); 

            return redirect('admin/add-edit-subject')->with('success_message',$message);
                // return response()->json(['type'=>'success','success_message'=>$message,'url'=>'subjects']);          
       }       
       $btns = [
           ['name'=>"<-- View Subjects ",'action'=>"admin/subjects", 'class'=>'btn btn-dark'],
           ['name'=>"Define Subject / Levels ",'action'=>"admin/manage-subject-for-levels", 'class'=>'btn btn-primary']];
      return view('admin.subjects.add_edit_subject',compact('page_info','subject','btns'));       
    }
    
    ## subjectForLevels
    public function subjectForLevels() {
      Session::put('page','course'); Session::put('subpage','subjects-for-level');
      $page_info = ['title'=>'Define Recommended Subjects For All Level ','icon'=>'pe-7s-notebook','sub-title'=>'This is where coures are defined for all students in every academic levels '];
      $btns = [
           ['name'=>"Create New Subject",'action'=>"admin/add-edit-subject", 'class'=>'btn btn-success'],
           ['name'=>"View All Subjects",'action'=>"admin/subjects", 'class'=>'btn btn-primary']
          ];
        
      $subjects = Subject::get()->toArray();  
      $levels = Level::all();
      $level_categories = LevelCategory::all()->toArray();
      ## $cur_session = AcademicCalendar::first()->pluck('current_session')[0];
      ## dd($cur_session);
      return view('admin.subjects.subject_for_levels',compact('page_info','subjects','btns','levels','level_categories'));   ## cur_session
    }
    
    public function load_level_subjects(Request $request) {
        if($request->ajax()){
            $data = $request->all();       
            $levels = $data['levels']; $levcategory = $data['level_category']; 
            $subjects = Subject::all()->toArray();           
            # $def_courses = LevelSubject::where(['level_id'=>$level,'session'=>$session])->get()->pluck('subject_id')->toArray();
             # $def_courses = LevelSubject::where(['level_id'=>$level,'session'=>$session])->get()->pluck('subject_id')->toArray();
             $level_names = Level::whereIn('id',$levels)->get()->pluck('name')->toArray();
             $level_ids = Level::whereIn('id',$levels)->get()->pluck('id')->toArray();
             $def_courses = LevelSubject::select('subject_id','level_ids')->where(['level_categ_id'=>$levcategory])->get()->pluck('level_ids','subject_id')->toArray();
              # print "<pre>";
              # print_r($def_courses);  die;               
            return response()->json([
               'view'=>(String)View::make('admin.subjects.level_subject_ajax')->with(compact('subjects','level_names','level_ids','levcategory','def_courses'))
            ]);
        }
    }
    
    public function submit_level_subjects_definition(Request $request) {
         if($request->ajax()){
            $data = $request->all();       
            #print "<pre>";# print_r($data); 
            #var_dump($data['level_ids']); die; 
            if(!is_null($data['courses'])){
                foreach($data['courses'] as $subject_id){
                    $courseDefn = LevelSubject::firstOrNew(['subject_id'=>$subject_id,'level_categ_id'=>$data['levcategory']]);
                    $courseDefn->subject_id = $subject_id;
                    $courseDefn->level_categ_id = $data['levcategory'];
                    ## work on classes defined 
                    $levels = empty($courseDefn->level_ids)?[]: explode(',', $courseDefn->level_ids); 
                    if(!empty($levels)){
                        $new_level = array_merge($levels, explode(',', $data['level_ids']));
                        $new_level = array_unique($new_level); 
                        $courseDefn->level_ids = implode(',', $new_level);
                    } else {
                      $courseDefn->level_ids = $data['level_ids'];  
                    }                    
                    $courseDefn->save();
                } ## end foreach
                return response()->json(['message'=>'Course Definition Succcessfully Saved']);
            } ## end not null
         } ## end ajax
    }
    
    public function remove_level_subjects_definition(Request $request) {
         if($request->ajax()){
            $data = $request->all();       
            $level_ids = $data['level_ids'];            
            if(!is_null($data['courses'])){                
                foreach($data['courses'] as $subject_id){
                    $courseDefn = LevelSubject::where(['subject_id'=>$subject_id,'level_categ_id'=>$data['levcategory']])->get()->toArray();
                    ## work on classes defined 
                    if(!empty($courseDefn)){
                        $defined = empty($courseDefn[0]['level_ids'])?[]: explode(',', $courseDefn[0]['level_ids']); 
                        $removing = explode(',',$level_ids); 
                        $left_over = array_diff($defined,$removing);
                        if(!empty($left_over)){
                            $rem = Arr::join($left_over, ','); ## update
                            LevelSubject::where(['subject_id'=>$subject_id,'level_categ_id'=>$data['levcategory']])->update(['level_ids'=>$rem]);
                        } 
                        else {  ## delete 
                            LevelSubject::where(['subject_id'=>$subject_id,'level_categ_id'=>$data['levcategory']])->delete();
                        }
                    } ## end not empty                     
                } ## end foreach
                return response()->json(['message'=>'Updates Succcessful']);
            } ## end not null
         } ## end ajax
    }
    
    public function subject_grading(Request $request, $gid=null){ ## grade_id
         Session::put('page','course'); Session::put('subpage','subject_grade_settings');
        if($gid==''){
           $page_info = ['title'=>'List of Subject Grades','icon'=>'pe-7s-notebook','sub-title'=>'Below are the list of Grades available'];      
           $grade = new SubjectGrade(); $message = "Subject Grade Successfully Saved"; 
       }
       else {
           $page_info = ['title'=>'Add / Update Subject Grade ','icon'=>'pe-7s-notebook','sub-title'=>'Below are the list of Grades available'];      
           $grade = SubjectGrade::find($gid); $message = "Subject Grade Successfully Updated"; 
       }
       
       $all_grades = SubjectGrade::orderBy('mark_from')->get(); 
       
       if($request->isMethod('post')){
           $data = $request->all(); ## print "<pre>"; print_r($data);  die;
            $rules = [
                'mark_from'=>"required|integer",
                'mark_to'=>"required|integer",
                'mark_grade'=>"required|string|max:3",
                'remarks'=>"required|string|max:30"
            ];
            $customMessage = [
               'mark_from.required'=>"Please fill in the mark from", 
               'mark_from.integer'=>"Mark must be number", 
               'mark_to.required'=>"Please fill in the mark from", 
               'mark_to.integer'=>"Mark must be number", 
               'mark_grade.required'=>"Please fill in the grade"
                ];
             ##$validator = Validator::make($data, $rules,$customMessage);
            
            $this->validate($request, $rules, $customMessage); 
            
            $grade->mark_from = $data['mark_from'];
            $grade->mark_to = $data['mark_to'];
            $grade->grade = $data['mark_grade'];
            $grade->remarks = $data['remarks']; 
            $grade->save(); 

            return redirect('admin/subject-grade-settings')->with('success_message',$message);
                // return response()->json(['type'=>'success','success_message'=>$message,'url'=>'subjects']);          
       }       
       $btns = [
           ['name'=>"<-- View Subjects ",'action'=>"admin/subjects", 'class'=>'btn btn-dark'],
           ['name'=>"Define Subject / Levels ",'action'=>"admin/manage-subject-for-levels", 'class'=>'btn btn-primary']];
      return view('admin.subjects.subject_grades_settings',compact('page_info','grade','btns','all_grades'));       
   
    }
   
    public function delete_subject_grade($id) {
        SubjectGrade::where('id',$id)->delete();
        $msg = "This grade has been deleted successfully";
        return redirect()->back()->with('success_message', $msg);  
    }
    
    public function test_exam_marks_setup(Request $request,$id=null) {
         
       Session::put('page','course'); Session::put('subpage','subject_grade_settings');
        if($id==''){
           $page_info = ['title'=>'Test and Exams Marks Setup','icon'=>'pe-7s-notebook','sub-title'=>' '];      
           $settings = new TestExamMarks; $message = "Test / Exam Marks Setup Successfully Saved"; 
       }
       else {
           $page_info = ['title'=>' Update Test and Exams Marks Setup ','icon'=>'pe-7s-notebook','sub-title'=>' '];      
           $settings = TestExamMarks::find($id); $message = "Test / Exam Marks Setup Successfully Updated"; 
       }       
       $all_scores = TestExamMarks::all(); 
       
       if($request->isMethod('post')){
           $data = $request->all(); ## print "<pre>"; print_r($data);  die;
            $rules = [
                'ca_1'=>"required|integer",
                'ca_2'=>"required|integer",
                'exam'=>"required|integer"                 
            ];
            $customMessage = [
               'ca_1.required'=>"Please fill in the 1st C.A Max Score", 
               'ca_1.integer'=>"Mark must be number", 
               'ca_2.required'=>"Please fill in the 2nd C.A Max Score", 
               'ca_2.integer'=>"Mark must be number", 
               'exam.required'=>"Please fill in the Exam Max Score"
                ];
             ##$validator = Validator::make($data, $rules,$customMessage);
            
            $this->validate($request, $rules, $customMessage); 
            
            $settings->ca_1 = $data['ca_1'];
            $settings->ca_2 = $data['ca_2'];
            $settings->exam = $data['exam'];            
            $settings->save(); 

            return redirect('admin/test_exam_marks_settings')->with('success_message',$message);
           // return response()->json(['type'=>'success','success_message'=>$message,'url'=>'subjects']);          
       }   
        return view('admin.subjects.test_exam_marks_settings',compact('page_info','settings','all_scores'));       
   
     }
     
     public function get_subject_name($subject_id) {
        $name = Subject::subjectName($subject_id); 
         return response()->json(['name'=>$name]);
     }
    
}
