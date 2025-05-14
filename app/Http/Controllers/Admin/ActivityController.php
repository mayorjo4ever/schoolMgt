<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Models\Admin;
use App\Models\EventsSettings;
use App\Models\Subject;
use App\Models\SubjectGrade;
use App\Models\TestExamMarks;
use App\Models\UsersClass;
use App\Models\UsersRegisteredCourses;
use App\Models\UsersResult;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use function get_student_position;
use function redirect;
use function response;
use function view;


class ActivityController extends Controller
{   
    public function __construct() {
       ## get all subjects cached
       if(Session::get('subjects')==null):
          $subjects = Subject::select('id','title')->get()->pluck('title','id');
          Session::put('subjects', $subjects);
       endif;
       
       ## get all marks cached for grading : A,B,C,D,E,F with remarks
        if(Session::get('marks')==null):
          $marks = SubjectGrade::select('mark_from','mark_to','grade','remarks')->get()->toArray();
          Session::put('marks', $marks);
       endif;
        
    }
    

    public function accessMyStudents(Request $request){       
     Session::put('page','my_students'); Session::put('subpage','my_students');       
       $page_info = ['title'=>'View My Students','icon'=>'pe-7s-users','sub-title'=>''];
      
       $id = Auth::id();        
       $sessions = range(date('Y'), 2022);
       $calendar = AcademicCalendar::get()->first();      
        
       $my_subjects = []; $my_classrooms = [];
        
        $admin = Admin::with('mysubjects','myclassgroups')->find($id); 
                          
        $pre_subjects = $admin->mysubjects; 
        $pre_classrooms = $admin->myclassgroups;
        if(!empty($pre_subjects)) { $my_subjects = explode(",",$pre_subjects['subject_ids']); }
        if(!empty($pre_classrooms)){ $my_classrooms = explode(",",$pre_classrooms['classroom_ids']); }            
        
       if($request->ajax()){   
           $data = $request->all();   #   print_r($data);   die;
           $rules = ['acad_session'=>'required',
               'my-class-room'=>'required','my-subjects'=>'required'];
               $this->validate($request, $rules); 
           $mysubjects =   $data['my-subjects'];
           
           $mystudents = UsersRegisteredCourses::where('session',$data['acad_session'])
               ->whereIn('class_room_id',$data['my-class-room'])->get();
            
           return response()->json([
                'view'=>(String)View::make('admin.staff.students.stud_search_ajax')->with(compact('mystudents','mysubjects'))
            ]);
       }     
       return view('admin.staff.students.my_students',compact('page_info','admin','my_subjects','my_classrooms','sessions','calendar'));
    }
    
    public function uploadResults(Request $request) {       
     Session::put('page','my_students'); Session::put('subpage','results_upload');       
       $page_info = ['title'=>'Upload / Compute Students Result','icon'=>'pe-7s-note','sub-title'=>''];
       
       $id = Auth::id();        
       $sessions = range(date('Y'), 2022);
       $calendar = AcademicCalendar::get()->first();       
       $time_schedule = EventsSettings::where('event_type','result-upload')->get()->first();
       $my_subjects = []; $my_classrooms = [];
        ## dd($calendar);
        $admin = Admin::with('mysubjects','myclassgroups')->find($id); 
                          
        $pre_subjects = $admin->mysubjects; 
        $pre_classrooms = $admin->myclassgroups;
        if(!empty($pre_subjects)) { $my_subjects = explode(",",$pre_subjects['subject_ids']); }
        if(!empty($pre_classrooms)){ $my_classrooms = explode(",",$pre_classrooms['classroom_ids']); }            
        
       ## manual method - student list 
       if($request->ajax()){   
           $data = $request->all();   #   print_r($data);   die;
           $rules = ['acad_session'=>'required',
               'my-class-room'=>'required','my-subjects'=>'required'];
               $this->validate($request, $rules); 
           $mysubjects =   $data['my-subjects'];
           $mystudents = UsersRegisteredCourses::where('session',$data['acad_session'])
               ->whereIn('class_room_id',$data['my-class-room'])->get();
           
           return response()->json([
                'view'=>(String)View::make('admin.staff.students.stud_search_ajax')->with(compact('mystudents','mysubjects'))
            ]);
       }     
       
       return view('admin.staff.students.results_uploads',compact('page_info','admin','my_subjects','my_classrooms','calendar','time_schedule'));
    }
    
    public function result_upload_manual_search(Request $request) {
        if($request->ajax()){
            $data = $request->all();             
            #$data = SubjectGrade::get_grade(78); ##print_r($data);
            $mystudents = UsersRegisteredCourses::query(); 
            $mystudents = $mystudents->where('session',$data['acad_session']); 
            
            if($data['regno']!=""){
                $mystudents = $mystudents->where('regno',$data['regno']);                    
            }  
            if($data['class-room']!=""){ $mystudents = $mystudents
               ->where('class_room_id',$data['class-room']);
            }
           $mystudents = $mystudents->get(); 
           
           ## taking to time  constraint - for period of registration 
           /***************************************************/
           $time_schedule = EventsSettings::where('event_type','result-upload')->get()->first();
           $upload_readonly =  ( Carbon::now() >= $time_schedule['start_date'] && Carbon::now() <= $time_schedule['end_date']) ? "" : "readonly disabled";
        
           
            return response()->json([
                'view'=>(String)View::make('admin.staff.students.manual_search_view_ajax')->with(compact('data','mystudents','upload_readonly'))
            ]);
        }
    }
    public function result_upload_bulk_search(Request $request) {
        if($request->ajax()){
            $data = $request->all();             
           
           $mystudents =  UsersRegisteredCourses::where('session',$data['acad_session'])
                   ->where('class_room_id',$data['class-room'])
                   ->get(); 
           
           ## taking to time  constraint - for period of registration 
           /***************************************************/
           $time_schedule = EventsSettings::where('event_type','result-upload')->get()->first();
           $upload_readonly =  ( Carbon::now() >= $time_schedule['start_date'] && Carbon::now() <= $time_schedule['end_date']) ? "" : "readonly disabled";
           /***************************************************/
           
            return response()->json([
                'view'=>(String)View::make('admin.staff.students.bulk_search_view_ajax')->with(compact('data','mystudents','upload_readonly'))
            ]);
        }
    }
    
    
    public function get_set_student_scores(Request $request)  {
        if($request->ajax()){
            $data = $request->all();  $params = explode("**",$data['params']);
            ## 	params: 7**tags0003**Ojo,Theophilus Jesutofunmi**2023/2024**1**22
            ## params : id, regno, name, session, term, subjectId
            $mark_settings = TestExamMarks::getSetings();
            $ca1_score = ""; $ca2_score = ""; $exam_score = ""; 
            $myscore = UsersResult::select('ca_1','ca_2','exam')
                ->where([
                'user_id'=>$params[0],
                'regno'=>$params[1],
                'session'=>$params[3],
                'term'=>$params[4],
                'subject_id'=>$params[5],
            ])
            ->get()->toArray(); // 
            if(!empty($myscore)):                
                $ca1_score = $myscore[0]['ca_1']; 
                $ca2_score = $myscore[0]['ca_2']; 
                $exam_score = $myscore[0]['exam']; 
            endif;
            
           ## print "<pre>"; 
           ## print_r($myscore); ## die; 
            
            return response()->json([
                'ca1_mark'=>$mark_settings['ca_1'],
                'ca2_mark'=>$mark_settings['ca_2'],
                'exam_mark'=>$mark_settings['exam'],
                'ca1_score'=>$ca1_score,
                'ca2_score'=>$ca2_score,
                'exam_score'=>$exam_score              
            ]);
        }
    }
    
    public function manually_save_student_scores(Request $request) {
        if($request->ajax()):
          $data = $request->all();  $params = explode("**",$data['result-params']);
          ## 	params: 7**tags0003**Ojo,Theophilus Jesutofunmi**2023/2024**1**22
          ## params : id, regno, name, session, term, subjectId
          ## print "<pre>";   print_r($data);
          $mark_settings = TestExamMarks::getSetings();
          $student = User::find($params[0]);
          // check which result is saved  
    
            $rules = ['ca1_score'=>"required|integer|max:".$mark_settings['ca_1'],
                      'ca2_score'=>"required|integer|max:".$mark_settings['ca_2'],
                      'exam_score'=>"required|integer|max:".$mark_settings['exam']
                    ];             
            $messages = [
                        'ca1_score.required' => "Enter 1st C.A Score",
                        'ca2_score.required' => "Enter 2nd C.A Score",
                        'exam_score.required' => "Enter Exam Score",
                        'ca1_score.integer' => "1st C.A Score must be number",
                        'ca2_score.integer' => "2nd C.A Score must be number",
                        'exam_score.integer' => "Exam Score must be number",
                        'ca2_score.max' => "2nd C.A Max Score is ".$mark_settings['ca_2'],
                        'ca1_score.max' => "1st C.A Max Score is ".$mark_settings['ca_1'],
                        'exam_score.max' => "Exam Max Score is ".$mark_settings['exam']
                  ];
            $validator = Validator::make($data, $rules,$messages);     
             if($validator->fails()): // or use $validator->passes()
                return response()->json(['status'=>'error','errors'=>$validator->messages()]);       
                else :                    
            $myscore = UsersResult::firstOrNew([
                'user_id'=>$params[0],
                'regno'=>$params[1],
                'session'=>$params[3],
                'term'=>$params[4],
                'subject_id'=>$params[5],
            ]);          
           $myscore->user_id = $params[0];
           $myscore->regno = $params[1];
           $myscore->session = $params[3];
           $myscore->term = $params[4];
           $myscore->subject_id = $params[5];
           $myscore->level_id = $student['current_level_id'];
           $myscore->class_room_id = $student['current_class_room_id'];
           //
           $myscore->ca_1 = $data['ca1_score'];
           $myscore->ca_1_max = $mark_settings['ca_1'];
           $myscore->ca_2 = $data['ca2_score'];
           $myscore->ca_2_max = $mark_settings['ca_2'];
           $myscore->exam = $data['exam_score'];
           $myscore->exam_max = $mark_settings['exam'];
           // 
           $myscore->upload_by = Auth::guard('admin')->user()->id;
           $myscore->save();
           
           return response()->json([
               'status'=>'success',
               'message'=>'Result successfully saved'
           ]); 
          endif;  // end if validation 
        endif; // ajax request 
    }
    
    // 
    public function students_results_view(Request $request) {
        Session::put('page','my_students'); Session::put('subpage','my_students_results');       
        $page_info = ['title'=>'View Students Results','icon'=>'pe-7s-users','sub-title'=>''];
      
       $id = Auth::id();        
       $sessions = range(date('Y'), 2022);
       $calendar = AcademicCalendar::get()->first();       
       $time_schedule = EventsSettings::where('event_type','result-upload')->get()->first();
       $my_subjects = []; $my_classrooms = [];
       ## dd(Session::get('subjects'));
       ## dd(Session::get('marks'));
       $admin = Admin::with('mysubjects','myclassgroups')->find($id); 
       
               
        $pre_subjects = $admin->mysubjects; 
        $pre_classrooms = $admin->myclassgroups;
        if(!empty($pre_subjects)) { $my_subjects = explode(",",$pre_subjects['subject_ids']); }
        if(!empty($pre_classrooms)){ $my_classrooms = explode(",",$pre_classrooms['classroom_ids']); }            
        
        return view('admin.student_result.results_view',compact('page_info','admin','sessions','my_subjects','my_classrooms','calendar','time_schedule'));
    }
    
    public function search_student_result_manually(Request $request) {
       ## updating admin info
       if($request->ajax()):
        
           $data = $request->all();   #   print_r($data);   die;
           $rules = ['regno'=>'required|string|max:20|exists:users,regno'];
           $messages = ['regno.required'=>'Provide The Student Registration Number',
               'regno.max'=>'Registration Number cannot be more than 20 Characters',
               'regno.exists'=>'This Registration Number Does Not Exists'];
            $validator = Validator::make($data, $rules,$messages);
              
            if($validator->fails()):
                return response()->json(['status'=>'error','errors'=>$validator->messages()]);       
             else :
                 $student = User::where('regno',$data['regno'])->first(); //->toArray();
                 $levels = UsersClass::where('user_id',$student->id)->get()->toArray();                   
                // return response()->json(['status'=>'success','message'=>'Student Found, Result will be shown later ']);       
            endif;
           
//           $mystudents = UsersRegisteredCourses::where('session',$data['acad_session'])
//          ->whereIn('class_room_id',$data['my-class-room'])->get();
            
           return response()->json([
               'status'=>'success','message'=>'Select From the Listed Sessions Below',
                'view'=>(String)View::make('admin.student_result.manual_search_ajax')->with(compact('student','levels'))
            ]);
        endif; ## end if ajax 
    }
    
    public function view_student_per_term_result($token) {    
        ## Session::put('page','my_students'); Session::put('subpage','my_students_results');       
        
        $tokens = base64_decode($token);    $params = explode("**", $tokens);          
        if(count($params) !=3):
            return redirect('admin/my-students-results')->with('error_message','Invalid Request') ;
        endif;
        
        $regno = base64_decode($params[0]);  $session = base64_decode($params[1]);
        $term = base64_decode($params[2]);
        
        $student = User::where('regno',$regno)->first(); 
        
        if(empty($student)):
         return redirect('admin/my-students-results')->with('error_message','Invalid Request !!!') ;
        else :
            $page_info = ['title'=> $student['name']. ' Sessional Results','icon'=>'pe-7s-note2','sub-title'=>''];
            $class_room_id = UsersClass::select('class_room_id')->where([
                'user_id'=>$student['id'],
                'regno'=>$student['regno'],
                'session'=>$session
                ])->groupBy('class_room_id')->pluck('class_room_id');
        return view("admin.student_result.per_term_result", compact('page_info','student','session','term','class_room_id'));
            
        endif;  
    }
    
    public function calculate_student_position(){ 
        echo " <h1> calculation is coming soon <h1/><h4><pre> "; 
         $array_results = ['tag1' => 95, 
            'tag2' => 98,'tag3' => 100, 
            'tag4' => 85,'tag5' => 90,
            'tag6' => 77]; 
        $mypos = get_student_position('tag6',$array_results);
        
        ## print($mypos);
        
        $groups = UsersResult::subject_group_results('2023/2024', 2, 3, 15);
        print_r($groups); 
        
        $class_groups = UsersResult::class_group_result('2023/2024', 2, 3);
        print_r($class_groups); 
        
        
    }
}
