<?php
   use App\Models\Term;   
   use App\Models\ClassRoom;
   use Carbon\Carbon;
   ?> 
 <div class="row">
      <div class="col-md-12">
         <div class="main-card mb-3 card">
             <div class="card-header title"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Class Attendance &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; <span class=" align-right btn btn-info font-size-lg font-weight-bold text-capitalize"> Today is : {!!  ordinal(days_spent_in_term(),true) !!} of {{days_in_term()}} Days </span>  &nbsp; &nbsp; &amp; &nbsp; &nbsp;<span class="btn btn-info font-size-lg font-weight-bold text-capitalize">{!! ordinal(weeks_spent_in_term(),true) !!} of {{ weeks_in_term() }} weeks </span> </div>
            <div class="card-body">
               <!-- start body form --> 
               <form class="needs-validation" novalidate id="studentClassAttendanceForm"  onsubmit="handleStudentClassAttendanceSearch()" action="javascript:void(0)" method="post">@csrf     
                  <div class="form-row">
                  <div class="col-md-2 mb-1">
                     <label for="title"  class="font-weight-bold"> Academic Session </label>
                     <input type="text" readonly="" name="session" id="session" class="form-control bg-white"  placeholder="Academic Session"  value="{{$calendar['current_session']}}" required >
                     <div class="invalid-feedback">
                        Enter Academic Session 
                     </div>
                  </div>
                  <!-- ./ col-md-2 -->
                 
                  <div class="col-md-2 mb-1">
                     <label for="title"  class="font-weight-bold text-capitalize">Term </label>
                     <select name="term" id="term" class="form-control" required="">
                        <?php ## $applicable_to = explode(',',$time_schedule['applicable_to']); ?>                                                                           
                        <option value="{{ $calendar['current_term']}}"> {{Term::name($calendar['current_term'])}} Term </option>                     
                     </select>
                     <?php # print_r($applicable_to); ?>
                     <div class="invalid-feedback">
                        Select Term
                     </div>
                  </div>
                  <!-- ./ col-md-3  -->
                  
                 <div class="col-md-2 mb-1">
                     <label for="title"  class="font-weight-bold text-capitalize"> Class Room  </label>
                     <select name="classroom" id="classroom" class="form-control" required="">
                        <?php ## $applicable_to = explode(',',$time_schedule['applicable_to']); ?>                                                                           
                            @foreach($classrooms as $classroom)
                         <option value="{{ $classroom['id'] }}"> {{ $classroom['name'] }} </option>                     
                            @endforeach
                     </select>
                     <?php # print_r($applicable_to); ?>
                     <div class="invalid-feedback">
                        Select Term
                     </div>
                  </div>
                  <!-- ./ col-md-3  -->
                  
                  <div class="col-md-3 mb-1">
                     <label for="title"  class="font-weight-bold"> Date </label>
                     <input type="text" name="date" id="date" class="bg-white form-control datepicker"  placeholder="Date"  value="{{Carbon::now()}}" required >
                     <div class="invalid-feedback">
                        Enter Academic Session 
                     </div>
                  </div>
                  <!-- ./ col-md-2 -->
                  <div class="col-md-3 mt-2"> &nbsp;                        
                     <button class=" btn btn-primary btn-lg w-100  stud-search-btn ladda-button" data-style="expand-right" type="submit"> <strong> List Students &nbsp; <span class="pe pe-7s-search"></span> </strong></button>
                  </div>
               </div>
               <!-- ./ form-row --> 
                </form> 
               
                <div class="mt-5" id="manual-student-list"></div>
                
            </div> 
         </div>
          
       
 
      </div>
      <!-- ./ col-md-12 --> 
      
   </div>
   <!-- ./ row -->
 
