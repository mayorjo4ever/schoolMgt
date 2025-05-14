<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuestionOptionImport;
use App\Models\Question;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use Illuminate\Support\Facades\View;


class QuestionController extends Controller
{
   
    public function qtnImportView() {
       Session::put('page','questions'); Session::put('subpage','import');
       $page_info = ['title'=>'Import Question ','icon'=>'fa fa-database','sub-title'=>'Importing Question is done via the use of microsoft excel book'];
       $btns = [
           ['name'=>"View Questions",'action'=>"admin/questions", 'class'=>'btn btn-dark'],
           ['name'=>"Download Excel Sample",'action'=>"admin/questions/download", 'class'=>'btn btn-success']];
       $subjects = Subject::get()->toArray();   
      # dd($subjects);
       return view('admin.questions.import_questions',compact('page_info','subjects','btns'));   
    }
    
    public function readExcel(Request $request) {
        
        $data = $request->all();
        
        Session::put('subject_id',$data['subject']); 
        Session::put('question_type',$data['type']); 
        
        Excel::import(new QuestionOptionImport, $data['file']);
        
        return redirect('admin/questions/view')->with('success_message','Questions successfully uploaded');
    }
    
    public function showQuestion(Request $request) {
       Session::put('page','questions'); Session::put('subpage','question-view');
       $page_info = ['title'=>'View Questions ','icon'=>'fa fa-database','sub-title'=>'Download available questions'];
       $btns = [
           ['name'=>"Import Questions",'action'=>"admin/questions/import", 'class'=>'btn btn-dark']
           ];
           ## $questions = Question::with(['options','subject'])->get()->toArray(); 
           $questions = null;          
          // Session::forget('submitTime');         
          if($request->isMethod('post')){              
              $data = $request->all(); ##  print "<pre>";
              Session::put('qtype',$data['type']);
              Session::put('sid',$data['subject']);
              #####################################
              /** $questions = Question::with(['options'=>function($query){
                   $query->inRandomOrder();
              }])->where(['type'=>$data['type'],'subject_id'=>$data['subject']])->inRandomOrder()->get()->toArray();
              **/
              $questions = Question::with('options')->where(['type'=>$data['type'],'subject_id'=>$data['subject']])->get()->toArray();              
             }
       $subjects = Subject::get()->toArray();    
       return view('admin.questions.questions',compact('page_info','subjects','btns','questions'));   
    }
    
    public function submitAnswers(Request $request) {
        if($request->isMethod('post')){
            $data = $request->all();         
            
           return view('admin.questions.timer')->with(compact('data')); 
        }
    }
    
    public function showTimer(Request $request) {
        if($request->ajax()){
            $data = $request->all(); $min = $data['closeTime'];
            return response()->json([                
              'view'=>(String)View::make('admin.arch_widgets.countDownTimer',compact('min'))]);
        }
    }
}
