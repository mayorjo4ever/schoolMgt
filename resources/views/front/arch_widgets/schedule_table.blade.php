<?php 
    use App\Models\Subject; 
?>
<div class="row">
   <div class="col-md-12">
      <div class="main-card mb-3 card">
         <div class="card-header">
            Test / Exam Schedules
            <div class="btn-actions-pane-right">
              <!--
              <div role="group" class="btn-group-sm btn-group">
                  <button class="active btn btn-focus">Last Week</button>
                  <button class="btn btn-focus">All Month</button>
               </div>-->
            </div>
         </div>
         <div class="table-responsive">
            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
               <thead>
                  <tr>
                     <th class="ml-3">#</th>
                     <th>Subject &nbsp;<span class="pe-7s-study pe-2x"></span></th>                     
                     <th class="">Time &nbsp;<span class="pe-7s-alarm pe-2x"></span></th>
                     <th class="">Status &nbsp;<span class="pe-7s-bell pe-2x"></span></th>
                     <th class="">Actions &nbsp;<span class="pe-7s-paper-plane pe-2x"></span></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($schedules as $k=>$schedule)              
                  <tr>  
                     <td class="ml-3 text-muted"># {{$k+1}}</td>
                     <td class="text-capitalize">
                         {{Subject::subjectName($schedule->subject_id) }}  &nbsp; <strong> {{ $schedule->paper_type}} </strong>
                     </td>
                     
                     <td class=""> {{ timeSchedule($schedule->hours,$schedule->minutes)}} </td>
                     <td class="text-capitalize font-weight-bold {{ empty($schedule->user->toarray()) ? " text-danger " : ""}}">
                         {{ empty($schedule->user->toarray()) ? " Not Scheduled " :$schedule->user->paper_status }}
                     </td>
                     <td class=""><?php 
                        $user_id = $schedule->user->user_id;
                        $sched_id = $schedule->id;
                        $subj_id = $schedule->subject_id; 
                        $paper_type = $schedule->paper_type;
                        $params = base64_encode("$user_id|$sched_id|$subj_id|$paper_type"); 
                     ?>
                         @if($schedule->user->paper_status == 'normal')
                         <a href="{{url('student/start-exam/'.$params)}}" class="btn btn-success btn-md"  @if(empty($schedule['users'])) disabled="" @endif >Start  </a>
                         @elseif($schedule->user->paper_status=='started')
                         <a href="{{url('student/boardroom')}}" class="btn btn-primary btn-md"  @if(empty($schedule['users'])) disabled="" @endif >Resume  </a>                        
                         @elseif($schedule->user->paper_status=='completed')
                         <a target="_blank" href="{{url('student/exams/'.$schedule->user->id.'/review')}}" class="btn btn-primary btn-md" >View Result  </a>
                         @endif
                         
                     </td> 
                  </tr>                 
                 @endforeach 
               </tbody>
            </table>
         </div>
          
      </div>
   </div>
</div>
