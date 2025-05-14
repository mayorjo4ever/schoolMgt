<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Models\EventsSettings;
use App\Models\Level;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function redirect;
use function view;

class AcademicController extends Controller
{
    //
    public function academic_levels() {
        Session::put('page','acad-settings'); Session::put('subpage','acad-levels');
        $page_info = ['title'=>'School Academic Levels','icon'=>'pe-7s-graph1','sub-title'=>'All Available Academic Levels '];
        $acad_levels = Level::all();     
        $btns = [['name'=>"Create New Level",'action'=>"admin/add-edit-level", 'class'=>'btn btn-primary']];
        return view('admin.academics.levels', compact('page_info','acad_levels','btns'));        
    }
    
    public function addEditLevel(Request $request, $id=null) {
        Session::put('page','acad-settings'); Session::put('subpage','acad-levels');
        $page_info = ['title'=>'Create New Level ','icon'=>'pe-7s-graph1','sub-title'=>'Below are all available Levels'];
        $btns = [['name'=>"View Academic Levels",'action'=>"admin/acad-levels", 'class'=>'btn btn-dark']];
      
        if($id == ""){
            $level = new Level;  $message = "Level Created Successfully";
        }
        else {
            $page_info['title'] = "Edit Academic Level"; 
            $level = Level::find($id); $message = "Level Updated Successfully";
        }        
        ## when submitting 
        if($request->isMethod('post')){
            $data = $request->all();
            $level->name = $data['name'];           
            $level->save();
            return redirect('admin/acad-levels')->with('success_message',$message);
        }
        return view('admin.academics.add_edit_levels', compact('level','btns','page_info')); 
    }
    
    public function edit_view_academic_calendar(Request $request, $id=1) {
        Session::put('page','acad-settings'); Session::put('subpage','acad-calendar');
        $page_info = ['title'=>'Update / View Academic Session and Term','icon'=>'pe-7s-wristwatch','sub-title'=>'You can update this settings'];
         
        $calendar = AcademicCalendar::firstOrNew(['id'=>1]);
        $sessions = range(date('Y'), 2022);
        $terms = Term::all();
        
        $td = Carbon::now();
       ## dd(cal_info(0)); 
        
        if($request->isMethod('post')){
        $data = $request->all();
        
        $rules = [
                'term_begins'=>'required|date',
                'term_ends'=>'required|date|after:term_begins',
                'next_term'=>'required|date|after:term_ends'
            ];         
        $this->validate($request, $rules);
        ## further validation 
        ######################################
        $begins = Carbon::create($data['term_begins']);
        $ending = Carbon::create($data['term_ends']); 
        ## $next_term = Carbon::create($data['next_term']);      
        ############################################         
        $expected_end =  $begins->addMonths(2);         
        $expected_next = $ending->addWeeks(2);
        #########################################
        $this->validate($request, 
                ['term_ends'=>'after:'.$expected_end,'next_term'=>'after:'.$expected_next],
                ['term_ends.after'=>'The end term must be 2 months interval after the beginning',
                 'next_term.after'=>'Next Term Must be at least 2 weeks after End of Term ']
                );
        $calendar->current_session = $data['cur_session']; 
        $calendar->current_term = $data['cur_term']; 
        $calendar->term_begins = $data['term_begins']; 
        $calendar->term_ends = $data['term_ends']; 
        $calendar->next_term_begins = $data['next_term']; 
        $calendar->save();
        return redirect()->back()->with('success_message','School Academic Calendar Successfully Updated');
         }
        return view('admin.academics.edit_session_and_term', compact('calendar','terms','sessions','page_info')); 
        
    }
    
    public function set_student_course_registration_calendar(Request $request){
        Session::put('page','acad-settings'); Session::put('subpage','set_stud_course_reg');
        $page_info = ['title'=>'Student Course Registration Settings','icon'=>'pe-7s-settings','sub-title'=>'Adjust the Session, Time Limit For Students to Register Their Courses.   '];
        $sessions = range(date('Y'), 2022);
        $calendar = AcademicCalendar::get()->first();                
        $levels = Level::all()->toArray();
        $time_schedule = EventsSettings::where('event_type','course-registration')->get()->first();
        
        ## when submitting 
       if($request->isMethod('post')){
        $data = $request->all();
        ## dd($data); 
        $rules = ['reg_session'=>'required',  'to_reg'=>'required','last_reg_date'=>'required|date'];         
        $this->validate($request, $rules);
       
        $settings = EventsSettings::firstOrNew([
            'event_type'=>'course-registration'
            ]);
            $settings->event_type = "course-registration"; 
            $settings->start_date = Carbon::now(); 
            $settings->end_date =  Carbon::create($data['last_reg_date']);
            $settings->applicable_to = implode(',', $data['to_reg']); 
            $settings->save();
            
           return redirect()->back()->with('success_message','Successfully Updated');
        }
        
        return view('admin.academics.student_course_reg_settings', compact('calendar','sessions','levels','time_schedule','page_info')); 
    }
    
    public function result_uploads_settings(Request $request){
        Session::put('page','acad-settings'); Session::put('subpage','result_upload_settings');
        $page_info = ['title'=>'Result Uploads Settings','icon'=>'pe-7s-edit','sub-title'=>'Adjust Adjust the duration for result uploading by staff members'];
        $sessions = range(date('Y'), 2022);
        $calendar = AcademicCalendar::get()->first();                
        $terms = Term::all()->toArray();
        $time_schedule = EventsSettings::where('event_type','result-upload')->get()->first();
         ## when submitting 
       if($request->isMethod('post')){
        $data = $request->all();
         ## dd($data); 
        $rules = ['acad_session'=>'required',  'terms'=>'required','start_date'=>'required|date','end_date'=>'required|date|after:start_date'];         
        $this->validate($request, $rules);
       
        $settings = EventsSettings::firstOrNew([
            'event_type'=>'result-upload'
            ]);
            $settings->event_type = "result-upload"; 
            $settings->start_date = Carbon::create($data['start_date']); 
            $settings->end_date =  Carbon::create($data['end_date']);
            $settings->applicable_to = implode(',', $data['terms']); 
            $settings->save();
            
           return redirect()->back()->with('success_message','Date for Result Uploads Successfully Updated');
        } 
        return view('admin.academics.result_uploads_settings', compact('calendar','sessions','terms','time_schedule','page_info')); 
    }
    
    
}

## TLgVP8UQq5KxbCTpid7rVALHNJ14p2JtXb
## TLgVP8UQq5KxbCTpid7rVALHNJ14p2JtXb
## TLgVP8UQq5KxbCTpid7rVALHNJ14p2JtXb