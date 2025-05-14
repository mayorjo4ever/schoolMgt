<?php
   use App\Models\Term;
   use App\Models\Subject;
   use App\Models\ClassRoom;
   ?>
<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
    <form class="needs-validation" novalidate id="studentResultSearchForm"  onsubmit="handleLecturerStudentResultSearch()" action="javascript:void(0)" method="post">@csrf     
    <div class="row">
      <div class="col-md-12">
         <div class="main-card mb-3 card">
            <div class="card-header title"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Manual Computation </div>
            <div class="card-body">
               <!-- start body form --> 
               <div class="form-row">
                  <div class="col-md-2 mb-1">
                     <label for="title"  class="font-weight-bold"> Academic Session </label>
                     <input type="text" readonly="" name="acad_session" id="acad_session" class="form-control bg-white"  placeholder="Academic Session"  value="{{$calendar['current_session']}}" required >
                     <div class="invalid-feedback">
                        Enter Academic Session 
                     </div>
                  </div>
                  <!-- ./ col-md-3  -->
                  <div class="col-md-2 mb-1">
                     <label for="title"  class="font-weight-bold text-capitalize">Term </label>
                     <select name="term" id="term" class="form-control" required="">
                        <?php  $applicable_to = explode(',',$time_schedule['applicable_to']); ?>  
                        @foreach($applicable_to as $term)                                 
                        <option value="{{$term}}"> {{Term::name($term)}} Term </option>
                        @endforeach
                     </select>
                     <?php # print_r($applicable_to); ?>
                     <div class="invalid-feedback">
                        Select Term
                     </div>
                  </div>
                  <!-- ./ col-md-3  -->
                  <div class="col-md-3 mb-1">
                     <label  class="font-weight-600">Subject </label>
                     <select name="subject" id="subject" class="form-control bg-white" required="">
                        @foreach($my_subjects as $subject_id)
                        <option value="{{$subject_id}}" > {{Subject::subjectName($subject_id) }}</option>
                        @endforeach 
                     </select>
                     <div class="invalid-feedback">
                        Select Your Subjects
                     </div>
                  </div>
                  <!-- col-md-3 -->
                  <div class="col-md-2 mb-1">
                     <label for="title" class="font-weight-600"> Class Room </label>
                     <select name="class-room" id="class-room" class="form-control bg-white">
                                                        
                        @foreach($my_classrooms as $classroom_id)
                        <option value="{{$classroom_id}}" > {{ClassRoom::name($classroom_id)}}</option>
                        @endforeach
                     </select>
                     <div class="invalid-feedback">
                        Select Class Room
                     </div>
                  </div>
                  <!-- col-md-3 -->
                  
                  <div class="col-md-2 mb-1">
                     <label for="title"  class="font-weight-bold"> Student Regno </label>
                     <input type="text" name="regno" id="regno" class="form-control bg-white"  placeholder="Student Regno"  value="" >
                     <div class="invalid-feedback">
                        Enter Academic Session 
                     </div>
                  </div>
                  <!-- ./ col-md-3  -->
                  
                  <div class="col-md-6 mt-0"> &nbsp;                        
                     <button class=" btn btn-primary btn-lg w-100  stud-search-btn ladda-button" data-style="expand-right" type="submit"> <strong> List Students &nbsp; <span class="pe pe-7s-search"></span> </strong></button>
                  </div>
               </div>
               <!-- ./ form-row -->
               
               <div id="manual-student-list" class="mt-4"></div>
               
            </div>
            <div class="d-block text-right card-footer">
              
            </div>
         </div>
      </div>
      <!-- ./ col-md-12 --> 
   </div>
   <!-- ./ row -->
  </form>
</div>

<!-- ./ tab-pane -->
