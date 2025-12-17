<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\Schedule;
use App\Models\UsersSchedule;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function greetings;
use function now;
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
        
        [$userId, $scheduleId, $subjectId, $paperType] =
            explode('|', base64_decode($params));

       #  print "<pre>";                                   #                              0         1           2           3
        ## $schedule = Schedule::with('user','subject')->findOrFail($infos[1]);
        ## $schedule = Schedule::with('user', 'subject')->findOrFail($scheduleId);
        $schedule = Schedule::findOrFail($scheduleId);
         $userSchedule = UsersSchedule::firstOrCreate(
            [
                'user_id' => $userId,
                'schedule_id' => $scheduleId,
            ],
            [
                'paper_status' => 'normal',
                'max_score' => $schedule->max_qtn,
            ]
        );
       /** -----------------------------------------
        * 1️⃣ BLOCK IF COMPLETED
        * ----------------------------------------*/
          // Block completed exam
            if ($userSchedule->paper_status === 'completed'):
                return redirect('student/exams')
                    ->with('error_message', 'Paper already completed');
            endif;
        
             // Resume if already started
            if ($userSchedule->paper_status === 'started'):
                return redirect('student/boardroom')
                    ->with('success_message', 'Resuming your exam');
            endif;
            
            // Start fresh exam
            $userSchedule->update([
                'paper_status' => 'started',
                'started_at'   => now(),
                'ends_at'      => now()->addMinutes($schedule->minutes)->addSeconds(3),
            ]);
           
            // Attach random questions ONCE
            $questionIds = Question::where('subject_id', $subjectId)
                ->where('type', $paperType)
                ->inRandomOrder()
                ->limit($schedule->max_qtn)
                ->pluck('id');

            foreach ($questionIds as $qid) {
                ExamQuestion::create([
                    'users_schedule_id' => $userSchedule->id,
                    'question_id' => $qid
                ]);
            } 
            
         return redirect('student/boardroom')
        ->with('success_message', 'Your Paper Will Start Now');
    }
    
    public function examroom(Request $request){
       Session::put('page','exam'); Session::put('subpage','exam');
       $page_info = ['title'=>'Examination Room','icon'=>'pe-7s-notebook','sub-title'=>'Below are papers scheduled for you to take'];
       $user_id = Auth::guard('student')->user()->id;
       $userSchedule = UsersSchedule::with('schedule.subject')
        ->where('user_id', $user_id)
        ->where('paper_status', 'started')
        ->firstOrFail();
        # print "<pre>";# print_r($userSchedule->toarray()); die;  // print_r($user_id); die;
             
        $questions = Question::with('options')
            ->whereIn(
                'id',
                ExamQuestion::where('users_schedule_id', $userSchedule->id)
                    ->pluck('question_id')
                )->get();

        // Load saved answers (question_id => option_id)
        $answers = Answer::where('users_schedule_id', $userSchedule->id)
            ->pluck('option_id', 'question_id');
        $min = Carbon::now()->addMinutes($userSchedule->minutes)->addSeconds(3); 
       # print_r($questions->toarray()); 
       # print_r($answers->toarray()); die;
        return view('front.exams.examroom', [
            'userSchedule' => $userSchedule,
            'questions'    => $questions,
            'answers'      => $answers,
            'min'          => $min 
        ]);
        
    }
    
    public function save_answers(Request $request) {
        if($request->ajax()):
        // print_r($request->all());
        $user_id = Auth::guard('student')->user()->id;
        $userSchedule = UsersSchedule::where('user_id', $user_id)
        ->where('paper_status', 'started')
        ->firstOrFail();

        $payload = $request->answers;

        $rows = [];

        foreach ($payload as $questionId => $optionId) {
            $rows[] = [
                'user_id' => $user_id,
                'users_schedule_id' => $userSchedule->id,
                'question_id' => $questionId,
                'option_id' => $optionId,
                'updated_at' => now(),
                'created_at' => now(),
            ];
        }

        Answer::upsert(
            $rows,
            ['user_id','users_schedule_id', 'question_id'], // unique keys
            ['option_id', 'updated_at']
        );

        return response()->json(['status' => 'saved']);
        endif;
    }
    
    public function submit(Request $request)
    {
        $userSchedule = UsersSchedule::findOrFail($request->users_schedule_id);

        if ($userSchedule->paper_status === 'completed') return;

        $score = Answer::where('users_schedule_id', $userSchedule->id)
            ->whereHas('option', fn($q) => $q->where('is_correct', 1))
            ->count();

        $userSchedule->update([
            'score' => $score,
            'paper_status' => 'completed',
            'submitted_at' => now(),
        ]);
    }

}
