<?php 
   use App\Models\Term;
   use App\Models\Level;
   use App\Models\UsersRegisteredCourses;  
   use App\Models\UsersResult;
   use App\Models\SubjectGrade;
   use App\Models\UsersClass; 
   use App\Models\ClassRoom; 
   use App\Models\ClassAttendanceLog;
   use App\Models\UsersAttendance;
   
   ?>
@extends('admin.arch_layouts.per_term_result_layout')
@section('content')

 <div class="row mt-0 pt-0">
   <div class="col-lg-8 offset-lg-2 ">
        <div class="main-card card">                 
            <div class="card-body mt-2 pt-0 mb-4 pb-4">
              <h6 class="text-center font-weight-600 text-uppercase"> {{ str_replace('_',' ',env('APP_NAME'))}} 
                    <br/><small class="">student sessional report card </small></h6>  
               <h6 class="text-center text-uppercase pt-0">
                   <small class="font-weight-600 "> {{$session}} - {{Term::name($term)}}&nbsp;Term Result</small>
               </h6> <hr class="mt-0 pt-0 border-dark pb-0 mb-0"/>                
               
                <?php 
                $overall_group_score =  UsersResult::class_group_result($session, $term, $class_room_id);
               ?>
               
               <div class="row">
                   <div class="col-md-12  mt-0 pt-0">
                       <table class="table table-sm table-bordered border-dark  mt-0 pt-0">
                           <tr>
                               <td class="font-weight-600 table-light">Name: </td>
                               <td class="font-weight-600">{{$student['name']}}</td>
                               <td class="font-weight-600 table-light">Registration No:</td>
                               <td class="text-uppercase font-weight-400">{{$student['regno']}}</td>
                           </tr> 
                           <tr>
                               <td class="font-weight-600 table-light">Current Level: </td>
                               <td class="font-weight-600">{{Level::name($student['current_level_id'])}}  &nbsp; / &nbsp; Classroom :  &nbsp;/ &nbsp;  {{ClassRoom::name($student['current_class_room_id'])}} </td>
                               <td class="font-weight-600 table-light">Gender:</td>
                               <td class="text-capitalize font-weight-400">{{ $student['gender']}}</td>
                           </tr>
                           <tr>
                               <td class="font-weight-600 table-light">Total in Class: </td>
                               <td class="font-weight-600">{{ UsersClass::total_in_class($class_room_id, $session)}}</td>
                               <td class="font-weight-600 table-light">Position:</td>
                               <td class="text-capitalize font-weight-600 font-size-lg">{!! get_student_position($student['regno'],$overall_group_score,2000)!!} </td>
                           </tr>
                           
                            <tr>
                               <td class="font-weight-600 table-light"> Days School Opens: </td>
                               <td class="font-weight-600 ">{{ ClassAttendanceLog::CountDaysOpened($session,$term,$class_room_id)}} &nbsp;Days</td>
                               <td class="font-weight-600 table-light"> Days Present </td>
                               <td class="text-capitalize font-weight-600">{{ UsersAttendance::CountDaysPresent($student['id'],$session,$term,$class_room_id)  }}&nbsp;Days </td>
                           </tr>
                       </table>
                   </div>
                   
                    <div class="col-md-12  mt-0 pt-0">
                       <table class="table table-sm table-bordered border-dark  mt-0 pt-0">
                           <tr class=" table-light text-uppercase text-center font-weight-600">
                               <td>Subjects: </td>
                               <td class="horizontal-rl">1st C.A</td>
                               <td class="horizontal-rl">2nd C.A</td>                               
                               <td class="horizontal-rl">Exam</td>                               
                               <td  class="horizontal-rl">Total</td>                               
                               <td class="horizontal-rl">Grade</td>                               
                               <td class="horizontal-rl">Position</td>                               
                               <td class="horizontal-rl">Remarks</td>                               
                           </tr> 
                           <?php 
                           $mysubjects = UsersRegisteredCourses::select('subject_ids')
                             ->where(['user_id'=>$student['id'],   
                                 'regno'=>$student['regno'],   'session'=>$session                               
                           ])->first()->toArray();
                           $subjects = explode(',',$mysubjects['subject_ids']);
                           ?>
                           
                           @foreach($subjects as $subject_id)
                           <tr class="text-center">
                               <?php # get computed results 
                            
                             $score = UsersResult::where([
                                'user_id'=>$student['id'],
                                'regno'=>$student['regno'],
                                'session'=>$session,
                                'term'=>$term,
                                'subject_id'=>$subject_id,
                                ])->get()->first();
                             
                              $group_score = UsersResult::subject_group_results($session, $term, $class_room_id, $subject_id);
                           
                             ?> 
                            <td class="font-weight-500 table-light">{{Session::get('subjects')[$subject_id]}} </td>
                               <td class="font-weight-400">{{$score['ca_1']??""}}</td>
                               <td class="font-weight-400">{{$score['ca_2']??""}}</td>                               
                               <td class="font-weight-400">{{$score['exam']??""}}</td>                               
                               <td class="font-weight-500"> @if(!empty($score)) {{ $total = $score['exam'] + $score['ca_2'] + $score['ca_1'] }} @endif</td>                               
                               <td class="font-weight-500"><?php $grade = empty($score) ? "" : SubjectGrade::get_grade($total);?> {{  empty($score) ? "" : $grade[0] }}</td>
                               <td class="font-weight-500 font-size-md">{!! !empty($score) ? get_student_position($student['regno'],$group_score) : "" !!}</td>
                               <td class="font-weight-500">{{  empty($score) ? "" : $grade[1]; }}</td>
                           </tr> 
                           @endforeach
                           <tr class="table-light">
                               <td colspan="5" class="text-right font-weight-600 text-uppercase">
                                  Total :  {{$overall_group_score[$student['regno']] }}
                                  / {{ count($subjects)*100 }}
                               </td>
                               <td colspan="3"></td>
                           </tr>
                       </table>
                   </div>  <!-- ./ col-md-12 -->
                   
               </div><!-- ./ row --> 
                
            </div>  <!-- ./ card-body -->
        </div> <!-- ./ main card -->
       
   </div> 
 </div>

@endsection
 

