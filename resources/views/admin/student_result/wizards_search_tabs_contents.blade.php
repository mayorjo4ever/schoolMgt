<?php
   use App\Models\Term;
   use App\Models\Subject;
   use App\Models\ClassRoom;
   ?>
<div class="tab-pane tabs-animation fade" id="tab-content-0" role="tabpanel">
    <form class="needs-validation" novalidate id="studentResultSearchForm"  onsubmit="handleLecturerStudentResultSearch()" action="javascript:void(0)" method="post">@csrf     
    <div class="row">
      <div class="col-md-12">
         <div class="main-card mb-3 card">
            <div class="card-header title"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Use Search Wizard </div>
            <div class="card-body">
               <!-- start body form --> 
               <div class="form-row">
                  <div class="col-md-3 mb-3">
                    <label class="font-weight-600">Academic Session </label>
                    <select name="acad_session" id="acad_session" class="form-control" required="">                                          
                    @foreach($sessions as $sess)
                    <?php $sess = $sess."/".($sess+1);?>
                    <option value="{{$sess}}" @selected($calendar['current_session']==$sess)> {{$sess}} </option> 
                    @endforeach
                    </select>
                    <div class="invalid-feedback">
                       Select Session
                    </div>
                 </div>
                      
                  <div class="col-md-3 mb-1">
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
                     <button class=" btn btn-primary btn-lg w-100  stud-search-btn ladda-button" data-style="expand-right" type="submit"> <strong> Search Students &nbsp; <span class="pe pe-7s-search"></span> </strong></button>
                  </div>
               </div>
               <!-- ./ form-row -->
               
               <div id="manual-student-list"></div>
               
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



