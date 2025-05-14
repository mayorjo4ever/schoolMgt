<?php

namespace App\Http\Controllers\Admin;
##use Intervention\Image\Typography\FontFactory;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\AcademicCalendar;
use App\Models\ClassRoom;
use App\Models\Country;
use App\Models\Level;
use App\Models\LevelCategory;
use App\Models\State;
use App\Models\Term;
use App\Models\User;
use App\Models\UsersClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades\Excel;
use function asset;
use function get_new_user_id;
use function redirect;
use function response;
use function url;
use function view;

class UserController extends Controller
{
    public function userImportView() {
       Session::put('page','students'); Session::put('subpage','student-import');
       $page_info = ['title'=>'Import New Students ','icon'=>'pe-7s-user','sub-title'=>'Importing Students with ease '];
       $btns = [
           ['name'=>"View Students",'action'=>"admin/students/view", 'class'=>'btn btn-dark']           
           ];        
      # dd($subjects);
       return view('admin.students.import_students',compact('page_info','btns'));   
    }
    
     public function readExcel(Request $request) {        
        $data = $request->all();                
        Excel::import(new UsersImport, $data['file']);        
        ## return redirect()->back()->with('success_message','Students successfully uploaded');
        return redirect('admin/students')->with('success_message','Students successfully uploaded');
    }
    ###################################
    
    public function students($filter=null) {
       Session::put('page','students'); Session::put('subpage','students');
       $page_info = ['title'=>'All Students ','icon'=>'pe-7s-user','sub-title'=>'List of available Students '];
       $btns = [
           ['name'=>"Add New Student",'action'=>"admin/add-new-student", 'class'=>'btn btn-success']
           ];        
        ## print "<pre>";
        $sessions = range(date('Y'), 2021);
        $students = User::paginate(20); ##get()->toArray(); 
        $levels = Level::select('id','name')->get()->pluck('name','id');
        $classrooms = ClassRoom::select('id','name')->get()->pluck('name','id');        
        ##print_r($classrooms); die; 
        
       return view('admin.students.students',compact('page_info','btns','students','levels','classrooms','sessions'));   
    }
    
    public function upload_passport(Request $request) {
       if($request->ajax()):
              $rules = ['picture'=>'mimes:jpg,jpeg,png'];
                $customMessage = ['picture.mimes'=>'Only Image File of type jpg, jpeg and png is allowed'];                
                $this->validate($request, $rules, $customMessage); //  
                
               $image_tmp = $request->file('picture'); 
                if($image_tmp->isValid()):
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand().uniqid().'.'.$extension; 
                    $smallImagePath = "images/students/temp/".$imageName;    
                    $watermark = "images/bg.png";
                   Session::put('current_temp_psp',$imageName);
                   Session::push('temp_psp', $imageName); 
                    // create new manager instance with desired driver
                    $manager = ImageManager::gd();               
                        $image = $manager->read($image_tmp);   
                        $image->resize(200,200);
                        $image->place($watermark,'bottom-left',20,0,100);                    
                    $image->save($smallImagePath);                    

                return response()->json([
                   'type'=>'success',
                   'message'=>'Upload Successful',
                   'path'=>asset($smallImagePath)
               ]);
                endif; ## end if valid  
                
       endif; ## end ajax
            
    }
    
    public function newStudentForm(Request $request, $id=null) {        
       Session::put('page','students'); Session::put('subpage','student-add');
       $page_info = ['title'=>'Add New Student ','icon'=>'pe-7s-user','sub-title'=>'Create New / Update Student Profile '];
       $btns = [
           ['name'=>"View All Student",'action'=>"admin/students", 'class'=>'btn btn-dark']
          ];        
       if($id=="") {
           $student = new User; 
       }
       else {
           $page_info['title'] = "Update Student Info";           
           $student = User::find($id); # ->get()->toArray();
           $message = "Student Profile Successfully Updated";
       }
       
       $sessions = range(date('Y'), 2021);
       $terms = Term::all(); $calendar = AcademicCalendar::firstOrNew(['id'=>1]); 
       $class_levels = Level::all(); ## ->toArray();
       $level_categs = LevelCategory::all();
       ## dd($class_levels); 
       
       return view('admin.students.add_edit_student')->with(compact('page_info','btns','student','sessions','terms','calendar','class_levels','level_categs'));
    }
    
    public function saveNewStudent(Request $request) {
        ## updating student info
       if($request->ajax()){
           $data = $request->all();
           ## print "<pre>"; print_r($data);   die;
           $id = base64_decode($data['stud_id']); 
           if($id>0){
               $student = User::firstOrNew(['id'=>$id]); 
               $message = "Student Profile Updated Successfully ";
           }
           else {
                $student = new User;
                $message = "New Student Successfully Created ";
           }
                   
           // $student = User::firstOrNew(['id'=>1]); 
           # $message = "New Student Successfully Created ";
           $student->name = $data['surname']." ".$data['firstname']." ".$data['othername'];
           $student->surname = $data['surname'];
           $student->firstname = $data['firstname'];
           $student->othername = $data['othername'];
           $student->email = $data['email'];
           $student->mobile = $data['mobile'];
           $student->gender = $data['gender'];
           $student->dob = $data['dob'];
           $student->residence = $data['residence'];
           $student->country_id = $data['country'];
           $student->state_id = $data['state'];
           $student->city_id = $data['city'];
           $student->session_of_entry = $data['session_admitted'];
           $student->term_of_entry = $data['term_admitted'];
           $student->level_admitted = $data['level_admitted'];
           $student->current_level_id = $data['level_admitted'];
           $student->class_room_admitted = $data['class_room'];
           $student->current_class_room_id = $data['class_room'];
           $student->level_category_admitted = $data['level_categ'];
           $student->current_level_category_id = $data['level_categ'];
           $student->date_admitted = $data['date_admitted'];
           $student->recorded_by = Auth::guard('admin')->user()->id;
           $student->recorded_date = Carbon::now();
           $student->program_status = 'process';
           $student->password = Hash::make(strtolower($data['surname']));
           $student->regno = ($id>0) ? $student->regno : get_new_user_id();
           ## updating passport
           if(Session::get('current_temp_psp')):
             $student->pix = $this->savePix($student->regno);  
            endif; 
           $student->save();
           
           ## check if student exist in users_class 
           $myclass = UsersClass::firstOrNew(['user_id'=>$student->id,
               'regno'=>$student->regno,'session'=>$data['session_admitted']]);
           
            $myclass->user_id = $student->id;
            $myclass->regno = $student->regno;
            $myclass->session = $data['session_admitted'];
            $myclass->level_id = $data['level_admitted'];
            $myclass->class_room_id = $data['class_room'];   
            $myclass->save(); 
            
            $this->clearpix();
            
           return response()->json([
               'message'=>$message,
               'status'=>'success',
               'dir'=>url('admin/add-new-student')]);
           #return redirect('admin/students')->with('success_message',$message);
       }        
    }
    
    protected function savePix($regno) {
        $name = str_replace("/", "", $regno).".png"; 
         if(Session::get('current_temp_psp')):
             $manager = ImageManager::gd();               
             $image = $manager->read("images/students/temp/".Session::get('current_temp_psp'));                 
             $newPath = "images/students/passports/".$name;
             $image->save($newPath);
             return $name;
         endif;
        return "";
    }


    protected function clearpix(){
        if(Session::get('current_temp_psp')):           
            foreach(Session::get('temp_psp') as $filename):
                unlink("images/students/temp/".$filename);
            endforeach;
            Session::forget('temp_psp');
            Session::forget('current_temp_psp');
        endif; 
    }
    ##
     public function getRoomByLevel(Request $request) {
        $data = $request->all(); $level = $data['level']; $stud_id = base64_decode($data['stud_id']); 
        $class_rooms = ClassRoom::getClassRooms($level);
        $student = ($stud_id >0)? User::find($stud_id) : new User;        
        return response()->json([
             'view'=>(String)View::make('admin.students.ajax_classroom_form')->with(compact('class_rooms','student'))
        ]);
    }
    
     public function load_country_states(Request $request) {
        $data = $request->all(); $country_id = $data['country_id']; 
        $states = Country::getStates($country_id); $stud_id = base64_decode($data['stud_id']); 
         $student = ($stud_id >0)? User::find($stud_id) : new User;
        return response()->json([
            'view'=>(String)View::make('admin.students.ajax_state_form')->with(compact('states','student'))
        ]);
    }
    
     public function load_state_cities(Request $request) {
        $data = $request->all(); $state_id = $data['state_id']; 
        $cities = State::getCities($state_id); $stud_id = base64_decode($data['stud_id']); 
         $student = ($stud_id >0)? User::find($stud_id) : new User;
        return response()->json([
            'view'=>(String)View::make('admin.students.ajax_city_form')->with(compact('cities','student'))
        ]);
    }
    
    
    
}
