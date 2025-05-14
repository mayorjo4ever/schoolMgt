<?php

namespace App\Imports;

use App\Models\TestExamMarks;
use App\Models\UsersRegisteredCourses;
use App\Models\UsersResult;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResultImport implements ToCollection, WithHeadingRow
{ 
    public function collection(Collection $rows)
    {
     
        $mark_settings = TestExamMarks::getSetings(); ##   print_r($mark_settings);
        $errors = [];  $success = [];
        $rules = ['1st_ca'=>"required|integer|max:".$mark_settings['ca_1'],
                      '2nd_ca'=>"required|integer|max:".$mark_settings['ca_2'],
                      'exam'=>"required|integer|max:".$mark_settings['exam']
                    ];  
        $messages = [
                    '1st_ca.required' => "1st C.A Score cannot be empty ",
                    '2nd_ca.required' => "2nd C.A  cannot be empty",
                    'exam.required' => " Exam  cannot be empty",
                    '1st_ca.integer' => "1st C.A Score must be number",
                    '2nd_ca.integer' => "2nd C.A Score must be number",
                    'exam.integer' => "Exam Score must be number",
                    '2nd_ca.max' => "2nd C.A Max Score is ".$mark_settings['ca_2'],
                    '1st_ca.max' => "1st C.A Max Score is ".$mark_settings['ca_1'],
                    'exam.max' => "Exam Max Score is ".$mark_settings['exam']
                  ];
         foreach($rows as $row){ 
            if(User::where('regno',$row['regno'])->exists()):
            ## check if the course is registered by the user
             $student = User::select('id','current_level_id')->where('regno',$row['regno'])->first()->toArray(); 
             ## check if subject is registerd by student 
             $params = ['user_id'=>$student['id'],'regno'=>$row['regno'],'session'=>Session::get('acad_session'),'class_room_id'=>Session::get('class-room')]; 
             if($this->student_register_subject($params,Session::get('subject_id'))): 
             ## validate  scores     
             
                $validator = Validator::make($row->toArray(), $rules,$messages);
             
             if($validator->passes()): 
                    ## prepare the text / exam scores 
                     $myscore = UsersResult::firstOrNew([
                        'user_id'=>$student['id'],
                        'regno'=>$row['regno'],
                        'session'=>Session::get('acad_session'),
                        'term'=>Session::get('term'),
                        'subject_id'=>Session::get('subject_id'),
                        ]);      
                        ## save result 
                        $myscore->user_id = $student['id'];
                        $myscore->regno = $row['regno'];
                        $myscore->session = Session::get('acad_session');
                        $myscore->term = Session::get('term');
                        $myscore->subject_id = Session::get('subject_id');
                        $myscore->level_id = $student['current_level_id'];
                        $myscore->class_room_id = Session::get('class-room'); ## or $student['current_class_room_id'];
                        //
                        $myscore->ca_1 = $row['1st_ca'];
                        $myscore->ca_1_max = $mark_settings['ca_1'];
                        $myscore->ca_2 = $row['2nd_ca'];
                        $myscore->ca_2_max = $mark_settings['ca_2'];
                        $myscore->exam = $row['exam'];
                        $myscore->exam_max = $mark_settings['exam'];
                        // 
                        $myscore->upload_by = Auth::guard('admin')->user()->id;
                        $myscore->save();
                        $success[] = $row['regno']." Result Uploaded Successfully ";
                 else :
                    $errors[] = $row['regno']." - ".  $validator->messages();
                    #$errors['message'] =  
                endif; ## passes validation of scores 
                else :
                    $errors[] = $row['regno']." - Did not register for the subject been uploaded  ";
                endif;## student did not register for the subject 
            else:
              $errors['regno'] = $row['regno'] . " does not exists ";             
                
            endif; ## exists
         } ## end foreach    
         
         Session::flash('success',$success);          
         Session::flash('errors',$errors); 
    }
    
      ## if the heading row did not start at the first row
     ## use the below funcion to specify where it started
     public function headingRow(): int     
     {
         return 1;
     }
     
     protected function student_register_subject(array $params, int $subject_id):bool {
         $rawsubjects = UsersRegisteredCourses::select('subject_ids')->where($params)->first(); 
         if(empty($rawsubjects)) : return false ; endif; 
         $subjects = explode(",",$rawsubjects['subject_ids']);
         return in_array($subject_id,$subjects);
     }
    
}
