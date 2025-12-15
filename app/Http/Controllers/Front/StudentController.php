<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Schedule;
use App\Models\UsersSchedule;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function greetings;
use function redirect;
use function view;

class StudentController extends Controller
{
    public function dashboard() {
        $id = Auth::guard('student')->user()->id; 
        $me = User::where('id',$id)->first(); 
        Session::put('page','dashboard'); Session::put('subpage','dashboard');       
        $page_info = ['title'=>greetings().$me['name'],'icon'=>'pe-7s-home','sub-title'=>'Education is the best legacy'];
         
        return view('front.dashboard',compact('page_info','me'));       
    }
    
    public function profile() {
       ## $id = Auth::id(); 
        $id = Auth::guard('student')->user()->id; 
        $me = User::where('id',$id)->first(); 
        Session::put('page','dashboard'); Session::put('subpage','profile');       
        $page_info = ['title'=>'My Profile','icon'=>'pe-7s-user','sub-title'=>''];
        $btns = [
           ['name'=>"<-- Back ",'action'=>"student/dashboard", 'class'=>'btn btn-primary'],
           ]; 
        
       return view('front.profile.profile',compact('page_info','me','btns'));       
    }
    
    public function view_courses($level = null){
        
    }
    
    public function examSchedules(Request $request) {
       Session::put('page','exam'); Session::put('subpage','exam');
       $page_info = ['title'=>'Available Test / Exam Schedules','icon'=>'pe-7s-notebook','sub-title'=>'Below are papers scheduled for you to take'];
       $btns = [
           ['name'=>"View Questions",'action'=>"admin/questions", 'class'=>'btn btn-dark'],
           ['name'=>"Download Excel Sample",'action'=>"admin/questions/download", 'class'=>'btn btn-success']];
       
       ## get paper schedules 
       $user_id = Auth::guard('student')->user()->id; 
       $schedules = Schedule::with(['user'=>function($query) use ($user_id) {
            $query->where('user_id',$user_id);
       }])->where('status',1)->get();
//        print "<pre>"; 
//        print_r($schedules->toarray());  die;
       // user submiting schedule
      
        return view('front.exams.dashboard', compact('page_info','schedules'));
    }
    
    public function start_exam($params=null){
        
        $infos =  explode("|",base64_decode($params));  #  $params = base64_encode("$user_id|$sched_id|$subj_id|$paper_type");
       #  print "<pre>";                                   #                              0         1           2           3
         $schedule = Schedule::with('user','subject')->findOrFail($infos[1]);
            $questions = Question::with('options')
                    ->where('subject_id',$infos[2]) 
                    ->where('type',$infos[3])
                    ->inRandomOrder()->limit($schedule->max_qtn)
                    ->get();
            
        if(empty(Session::get('questions')) && empty(Session::get('schedule'))):            
            Session::put('schedule',$schedule);
            Session::put('questions',$questions);             
        endif;
        
        
        switch($schedule->user->paper_status):
            case 'normal':
            case 'started':                
                UsersSchedule::where(['user_id'=>$infos[0],'schedule_id'=>$infos[1]])->update(['paper_status'=>'started']);                
                return redirect('student/examroom')->with('success_message','Your Paper Will Start Now'); break;
            case 'completed':
                return redirect('student/exams')->with('error_message','Paper Aleady Completed'); break;
        endswitch;
        
        //print_r(Session::get('schedule')->toarray());
        // print_r(Session::get('questions')->toarray());
        # print $infos[2]; print $infos[3];
    }
    
    public function examroom(Request $request){
       Session::put('page','exam'); Session::put('subpage','exam');
       $page_info = ['title'=>'Examination Room','icon'=>'pe-7s-notebook','sub-title'=>'Below are papers scheduled for you to take'];
       $schedule = Session::get('schedule');
       $min = Carbon::now()->addMinutes($schedule->minutes)->addSeconds(5)->toIso8601String();  // * 60; 
             //  dd($min); die; 
        return view('front.exams.examroom',compact('page_info','min')); 
        
    }
}
