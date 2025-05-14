<?php 
   use App\Models\LevelCategory; 
   ?>
<div class="table-light pt-3 pb-3 pl-4 mt-4 mb-3 h5 text-capitalize text-center">
   Course definition for [ {{Arr::join($level_names,', ',' and ')}} ]  - [ {{ LevelCategory::name($levcategory)}} Class ]
</div>
<form method="post" id="subject-level-definition" action="javascript:void(0)">
   @csrf    
   <div class="form-row mt-4 mb-3">
      <div class="col-md-4 offset-1">
         <button type="submit" class="btn btn-primary finalize-level-subject-btn w-100 btn-lg font-weight-bold ladda-button" data-style="expand-right">Save Select ( <span class="tot-subject">0</span> ) Courses  </button>
         <input type="hidden" name="levcategory" id="levcategory"  value="{{$levcategory}}" />
         <input type="hidden" name="level_ids" value="{{Arr::join($level_ids,',')}}" />
      </div>
      <div class="col-md-4 offset-1">
         <button type="submit" class="btn btn-danger remove-level-subject-btn w-100 btn-lg font-weight-bold ladda-button" data-style="expand-right">Remove Selected ( <span class="tot-subject">0</span> ) Courses </button>
      </div>
   </div>
   <div class="form-row">
      @foreach($subjects as $subject)
      <div class="col-md-4 mt-2 mb-2 w-75  table table-bordered ">
         <div class="mt-2 mb-2">
            <div class="custom-checkbox custom-control custom-control-inline">
               <input onclick="count_selected_courses()" type="checkbox" name="courses[]" value="{{$subject['id']}}"  id="custom_{{$subject['id']}}" class="level-subject-custom custom-control-input" 
               @if(check_subject_levels($subject['id'],$def_courses,$level_ids)==1) checked="" @endif>
               &nbsp; &nbsp; 
               <label class="custom-control-label" for="custom_{{$subject['id']}}">
               {{$subject['title']}}  &nbsp; &nbsp; </label>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</form>
