<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Models\ClassAttendanceLog;
use App\Models\ClassRoom;
use App\Models\User;
use App\Models\UsersAttendance;
use App\Models\UsersRegisteredCourses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use function redirect;
use function response;
use function view;


class AttendanceController extends Controller
{
    public function attendance_view(Request $request)  {
        Session::put('page','my_students'); Session::put('subpage','class_attendance');       
        $page_info = ['title'=>'Take Class Attendance For Students','icon'=>'pe-7s-graph1','sub-title'=>''];
        
       $id = Auth::id();               
       $calendar = AcademicCalendar::get()->first();  
       $classrooms = ClassRoom::all()->toArray();       
       ## dd($classrooms);        
       return view('admin.student_attendance.view',compact('page_info','calendar','classrooms'));
    }
    
    public function student_search(Request $request) {
        if($request->ajax()):
            $data = $request->all();     ##     print_r($data); die; 
            $level_id = ClassRoom::select('level_id')->where('id',$data['classroom'])->get()->pluck('level_id');
            
            $dateparse = Carbon::parse($data['date']); 
            $date = $dateparse->toDateString();   ## ymd
            ## validate the date : 
                        
            if($dateparse->isWeekend()):
                  return  response()->json([
                    'type'=>'error',
                      'message'=>'Attendance Cannot be Taken on Weekends'                    
                    ]);
                else :                 
                  $mystudents = UsersRegisteredCourses::where('session',$data['session'])
                    ->where('class_room_id',$data['classroom'])->get();
            
                    $attendanceLog = ClassAttendanceLog::where([
                    'session'=>$data['session'],'term'=>$data['term'], 'level_id'=>$level_id[0],
                    'class_room_id'=>$data['classroom'], 'date'=>$date])->get()->toArray();
            
                    $attendants = UsersAttendance::select('user_id','regno')->where([                     
                        'session'=>$data['session'],'term'=>$data['term'], 'level_id'=>$level_id[0],
                         'class_room_id'=>$data['classroom'], 'date'=>$date
                     ])->get()->pluck('regno','user_id')->toArray();  
                     
                   $attendance_dates = ClassAttendanceLog::DaysOpened($data['session'], $data['term'], $data['classroom']);
                   
                   Carbon::parse("")->gt($date); 
                   
                return response()->json([
                    'type'=>'success',
                    'view'=>(String)View::make('admin.student_attendance.stud_search_ajax')->with(compact('mystudents','data','attendants','attendanceLog','attendance_dates'))
                ]);            
            endif;        
        endif;        
    }
    
    public function submit_attendance(Request $request,$params,$students='') {
        $data = $request->all(); 
        $info = explode("|", base64_decode($params)); 
        
        if(count($info) !=4): ## invalid request
            return redirect('admin/take-class-attendance')->with('error_message','Invalid Request'); 
        endif; 
        
        if($students == ""):  ## all are absent 
             return redirect('admin/take-class-attendance')->with('success_message','No Student is present in the class for attendance'); 
        endif;
        
        if($students != ""):  ## now record attendance 
            ## info contains session,term,classroom,date 
            #                   0      1      2       3
            $level_id = ClassRoom::select('level_id')->where('id',$info[2])->get()->pluck('level_id');
            $date = Carbon::parse($info[3])->toDateString();    
            # Carbon::parse($info[3])->toDayDateTimeString()
           $attendants = explode(",",$students);  
            ##  dd( $date);
            $attendanceLog = ClassAttendanceLog::firstOrNew([
                'session'=>$info[0],'term'=>$info[1],'level_id'=>$level_id[0], 
                'class_room_id'=>$info[2], 'date'=>$date]);
            
             $attendanceLog->session = $info[0];              
             $attendanceLog->term = $info[1]; 
             $attendanceLog->level_id = $level_id[0]; 
             $attendanceLog->class_room_id = $info[2]; 
             $attendanceLog->date = $date; 
             $attendanceLog->taken_by = Auth::id();              
             $attendanceLog->save();
             
             ## manage student attendance too 
             foreach($attendants as $user_id):
                 $me = User::select('regno')->where('id',$user_id)->get()->pluck('regno')->toArray();
                 ## print_r($me);  print "<br/>"; 
                  $myAttendance = UsersAttendance::firstOrNew([
                     'user_id'=>$user_id,'regno'=>$me[0],
                    'session'=>$info[0],'term'=>$info[1],'level_id'=>$level_id[0], 
                    'class_room_id'=>$info[2], 'date'=>$date
                 ]); 
                  $myAttendance->user_id = $user_id; 
                  $myAttendance->regno = $me[0]; 
                  $myAttendance->session = $info[0]; 
                  $myAttendance->term = $info[1]; 
                  $myAttendance->level_id = $level_id[0]; 
                  $myAttendance->class_room_id = $info[2]; 
                  $myAttendance->date = $date; 
                  $myAttendance->is_present = true; 
                  $myAttendance->save();  
                  
             endforeach;
             
              return redirect('admin/take-class-attendance')->with('success_message', count($attendants). "  student(s) recorded present in the class for attendance"); 
        endif;
        
        
        
    }
}
