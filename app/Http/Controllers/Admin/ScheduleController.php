<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ResultExport;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use App\Models\UsersSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function response;
use function view;


class ScheduleController extends Controller
{
    public function schedules(){
        Session::put('page','schedules'); Session::put('subpage','schedules');
        $page_info = ['title'=>'View Schedules ','icon'=>'pe-7s-alarm','sub-title'=>'Schedule your students for exams and test '];
        $btns = [
            ['name'=>"Create New Schedule",'action'=>"admin/add-edit-schedule", 'class'=>'btn btn-success']
        ];
        $schedules = Schedule::with(['users'])->get()->toArray(); 
        # dd($schedules);
        return view('admin.schedules.schedules',compact('page_info','btns','schedules'));         

    }
    
    public function addEditSchedule(Request $request,$id=null){
        Session::put('page','schedules'); Session::put('subpage','addschedule');

        $page_info = ['title'=>'Create New Schedule ','icon'=>'pe-7s-alarm','sub-title'=>'Add / Edit Schedules for your student '];
        $btns = [
            ['name'=>"<-- View Schedule",'action'=>"admin/schedules", 'class'=>'btn btn-dark']
        ];
        if($id==""){
            $schedule = new Schedule;
           $page_info['title'] = "Create New Schedule";
           $message = "Schedule Created Successfully";
           $schedusers = array();
        }
        else {
            $schedule = Schedule::find($id);
            ## $schedule = Schedule::with(['users'])->where('id',$id)->get(); 
            #$schedusers = UsersSchedule::where('schedule_id',$id)->get()->toArray();
            $schedusers = UsersSchedule::where('schedule_id',$id)->get()->pluck(['user_id'])->toArray();
            $page_info['title'] = "Edit Schedule";
            $message = "Schedule Updated Successfully"; 
        }
        
         $users = User::get()->toArray();
         
         // print "<pre>"; 
         // print_r($schedusers); 
        // print_r($users);  // die;           
        
//        if($request->isMethod('post')){
//            $data = $request->all();  # print "<pre>"; 
//             #print_r($data);           die; 
//            
//            //set up rules for validation
//            $rules = [
//              'subject'=>'required',
//              'paper_type'=>'required',
//              'allqtn'=>'required',
//              'hours'=>'required',
//              'minutes'=>'required',
//              'maxqtn' =>'required|numeric'
//            ]; 
//             
//            $this->validate($request, $rules);
//            
//            if($data['maxqtn'] == 0 ||  $data['allqtn'] == 0  || ($data['maxqtn'] >  $data['allqtn']))
//            {
//                return redirect()->back()->with('error_message','please check the questions very well, it is not valid');
//            }
//            else {
//            
//            $schedule->subject_id = $data['subject'];
//            $schedule->hours = $data['hours'];
//            $schedule->minutes = $data['minutes'];
//            $schedule->paper_type = $data['paper_type'];
//            $schedule->max_qtn = $data['maxqtn'];
//            $schedule->status = 1;
//            $schedule->save();
//            $id = $schedule->id; 
//            #print "<pre>"; 
//             ## create their schedule too 
//            if(isset($data['remove_prev_stud'])){
//                UsersSchedule::where('schedule_id',$id)->delete(); 
//                foreach($data['students'] as $user_id){                
//                    $sched = new UsersSchedule();                        
//                    $sched->user_id = $user_id;
//                    $sched->schedule_id = $id;
//                    $sched->save();                          
//                } ## end foreach                
//            }
//            else {
//                foreach($data['students'] as $user_id){
//                    $sched = UsersSchedule::firstOrNew(['schedule_id'=>$id,'user_id'=>$user_id]); 
//                    $sched->user_id = $user_id;
//                    $sched->schedule_id = $id;
//                    $sched->save(); 
//               } ## end foreach      
//            }                       
//            return redirect('admin/schedules')->with('success_message',$message); 
//            }  // end else - no error
//        }        
        $subjects = Subject::get()->toArray();         
        return view('admin.schedules.add_edit_sched',compact('page_info','btns','subjects','schedule','schedusers','users'));   
    }
    
    public function updateScheduleStatus(Request $request) {
        if($request->ajax()){
            $data = $request->all();            
            if($data['status']=='active') { $status = 0;  } else { $status = 1; }
            // do update
            Schedule::where('id',$data['schedule_id'])->update(['status'=>$status]); 
            return response()->json(['status'=>$status,'schedule_id'=>$data['schedule_id']]); 
        }
    }
    
    ## get available questions to setup schedules
    public function getAvailQtns(Request $request ) {
        if($request->ajax()){
            $data = $request->all();            
            $questions = Question::where(['type'=>$data['paper_type'],'subject_id'=>$data['subject_id']])->get()->count();
            return response()->json(['value'=>$questions]); 
        }
    }
    
    public function scheduledStudents(Request $request, $id){
       $schedule = Schedule::with('users')->find($id)->toArray(); 
       ## dd($schedule); 
        Session::put('page','schedules'); Session::put('subpage','schedules');
        $page_info = ['title'=>'Scheduled Users ','icon'=>'pe-7s-alarm','sub-title'=>'This page shows the status of users scheduled with their results'];
        $btns = [
            ['name'=>"<-- Back",'action'=>"admin/schedules", 'class'=>'btn btn-dark'],
            ['name'=>"Download Result (Excel)",'action'=>"admin/download-results/".$id, 'class'=>'btn btn-success']
        ];       
       
        return view('admin.schedules.scheduled_users',compact('page_info','btns','schedule'));              
    }
    
    public function downloadResult($sched_id) {
       $schedule = Schedule::find($sched_id);
       $code = Subject::subjectCode($schedule['subject_id']);
       $title = Subject::subjectName($schedule['subject_id']) ."-". strtoupper($schedule['paper_type']);
       $filename = $code."-". strtoupper($schedule['paper_type']).".xlsx";
       $info = ['title'=>$title,'sched_id'=>$sched_id];
       return Excel::download(new ResultExport($info), $filename);
    }
}
