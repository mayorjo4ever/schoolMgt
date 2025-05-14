<?php
   use App\Models\Term;
   use App\Models\Subject;
   use App\Models\ClassRoom;
   ?>
<div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">   
    <div class="row">
      <div class="col-md-12">
         <div class="mb-3 card"> 
            <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Upload Results For Multiple Students   </div>
            <div class="card-body"> <form class="needs-validation" novalidate id="bulkStudentResultSearchForm"  onsubmit="handleLecturerBulkStudentResultSearch()" action="javascript:void(0)" method="post">@csrf     
                 <!-- start body form --> 
               <div class="form-row mb-5">  <div class="col-md-2 mb-1">
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
                   <div class="col-md-3 mt-2"> &nbsp;                        
                     <button class=" btn btn-primary btn-lg w-100  stud-search-btn ladda-button" data-style="expand-right" type="submit"> <strong> Initiate Upload &nbsp; <span class="pe pe-7s-cloud-upload"></span> </strong></button>
                  </div>
                </div>
               <!-- ./ form-row -->
                 
               </form>
                
                <div id="bulk-student-file-upload"><center class="font-size-lg"><span class="fa fa-spin fa-spinner fa-3x "></span>&nbsp; &nbsp;  Click on <b>Initiate Upload Button</b> to Start </center> </div>
                 
            </div> <!-- /. card-body -->
           
           
            
         </div> <!-- /. card -->
      </div> <!-- ./ col-md-12 --> 
   </div> <!-- ./ row -->
   
    
    
    
</div>

  
              
<!-- ./ tab-pane -->



