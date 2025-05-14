<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Models\EventsSettings;
use App\Models\LevelSubject;
use App\Models\UsersRegisteredCourses;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function redirect;
use function view;

class CourseRegController extends Controller
{
    //
    public function start_reg(Request $request) {
      $id = Auth::guard('student')->user()->id; 
      $me = User::where('id',$id)->first(); 
      Session::put('page','reg_payment'); Session::put('subpage','course_reg');       
      $page_info = ['title'=>'Student Course Registration','icon'=>'pe-7s-notebook','sub-title'=>''];      
      ##
      $calendar = AcademicCalendar::first(); #->toArray()
      $levcategory = $me->current_level_category_id; 
      $def_courses = LevelSubject::select('subject_id','level_ids')->where(['level_categ_id'=>$levcategory])->get()->pluck('level_ids','subject_id')->toArray();
      $myregisteredcoures =   UsersRegisteredCourses::select('subject_ids')->where([
        'user_id'=>$me->id, 'regno'=>$me->regno,'level_id'=>$me->current_level_id,
        'session'=>$calendar->current_session,'level_categ_id'=>$me->current_level_category_id
      ])->get()->first();
      
      ## get time setting for registration 
      /**************************************/
      $time_schedule = EventsSettings::where('event_type','course-registration')->get()->first();
     ##  dd($time_schedule); 
      /* "event_type" => "course-registration"
                "start_date" => "2023-11-25 13:12:28"
                "end_date" => "2023-12-08 00:00:00"
                "applicable_to" => "1,2,4"*/
      
      ## dd($myregisteredcoures,$me->id,$me->regno,$me->current_level_id,$calendar->current_session); 
       $mySavedCourses = empty($myregisteredcoures)?[] : explode(',',$myregisteredcoures->subject_ids); 
      ## dd($mySavedCourses);
      ## when submitting form 
      if($request->isMethod('post')){
          $data = $request->all(); 
          $message = "Course Registration Successfully Saved"; 
          $rules = ['subjects'=>'required|array|min:8'];
          $msg = ['subjects.required'=>'Select the courses',
             'subjects.min'=>'You must register a minimum of 8 courses'];
          $this->validate($request, $rules,$msg);
          # print "<pre>"; 
          # print_r($data); die;  
          $subjects = implode(',',$data['subjects']); 
          $mycoursereg = UsersRegisteredCourses::firstOrNew([
            'user_id'=>$data['student'], 'regno'=>$data['regno'],
            'level_id'=>$data['level'],'session'=>$data['session'],
            'level_categ_id'=>$data['level_categ']
          ]); 
          $mycoursereg->user_id = $data['student']; 
          $mycoursereg->regno = $data['regno']; 
          $mycoursereg->level_id = $data['level']; 
          $mycoursereg->session = $data['session']; 
          $mycoursereg->level_categ_id = $data['level_categ']; 
          $mycoursereg->class_room_id = $data['classroom']; 
          $mycoursereg->subject_ids = $subjects; 
          $mycoursereg->save(); 

          return redirect()->back()->with('success_message',$message);
      }
      
       return view('front.courses.registration',compact('page_info','me','calendar','def_courses','mySavedCourses','time_schedule'));             
    }
}
