<?php
   use App\Models\Subject; 
   use App\Models\ClassRoom;
   
   ?>
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
         Select  Session
      </div>
   </div>
   <!-- col-md-3  -->
   <div class="col-md-3 mb-3">
      <label  class="font-weight-600">My Subjects  </label>
      <select multiple="" name="my-subjects[]" id="my-subjects" class="form-control bg-white" required="">
         @foreach($my_subjects as $subject_id)
         <option value="{{$subject_id}}" > {{Subject::subjectName($subject_id) }}</option>
         @endforeach 
      </select>
      <div class="invalid-feedback">
         Select Your Subjects
      </div>
   </div>
   <!-- col-md-3 -->
   <div class="col-md-3 mb-3">
      <label for="title" class="font-weight-600"> Class Groups </label>
      <select multiple="" name="my-class-room[]" id="my-class-room" class="form-control bg-white" required="">
         @foreach($my_classrooms as $classroom_id)
         <option value="{{$classroom_id}}" > {{ClassRoom::name($classroom_id)}}</option>
         @endforeach
      </select>
      <div class="invalid-feedback">
         Select One or More Class Groups
      </div>
   </div>
   <!-- col-md-3 -->
   <div class="col-md-3 mb-3"> &nbsp;                        
      <button class="mt-2 btn btn-primary btn-lg w-100  stud-search-btn ladda-button" data-style="expand-right" type="submit"> <strong> Search &nbsp; <span class="pe pe-7s-search"></span> </strong></button>
   </div>
</div>
<!-- ./ form-row -->
