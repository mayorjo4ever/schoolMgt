<?php 
    use Carbon\Carbon;
?>
  <span class="ajaxLoader bg-dark h2 ladda-button " data-style="expand-right"></span> 
  
  <h6 class="font-weight-bold mt-2 text-uppercase"> Admission Details </h6>
  <hr class="mb-0 mt-0"/>
  
  <div class="form-row mt-4"> 
   <div class="col-md-4 mb-3">
        <label for="title" class=""> Session Admitted </label>
        <select name="session_admitted" class="form-control" required="">
            <option value=""  > ... </option>                                
            @foreach($sessions as $sess)
            <?php $sess = $sess."/".($sess+1);?>
            <option value="{{$sess}}"  @selected($calendar['current_session']==$sess) @selected($student['session_of_entry']==$sess)   > {{$sess}} </option> 
            @endforeach
        </select>
        <div class="invalid-feedback">
           Provide Current Session
        </div>
     </div>     <!-- ./ col-md-4 -->

  <div class="col-md-4 mb-3">
      <label for="title" class="">Term Admitted </label>
       <select name="term_admitted" class="form-control" required="">
            <option value=""  > ... </option>                                
           @foreach($terms as $term)
            <option value="{{$term['id']}}" @selected( $term['id']===$calendar['current_term']) @selected($student['term_of_entry']==$sess) > {{ $term['name']}} Term </option>   
           @endforeach
        </select>
      <div class="invalid-feedback">
         Select Term Admitted
      </div>
   </div>    <!-- ./ col-md-4 -->
    
   
   
  <div class="col-md-4 mb-3">
      <label for="title" class=""> Level Admitted </label>
       <select name="level_admitted" id="level_admitted" class="form-control" required="">
            <option value=""  > ... </option>                                
           @foreach($class_levels as $level)
            <option value="{{$level['id']}}" @selected($student['level_admitted']==$level['id'])>{{ $level['name']}}</option>   
           @endforeach
        </select>
      <div class="invalid-feedback">
         Select Level Admitted
      </div>
   </div>    <!-- ./ col-md-4 -->
</div> <!-- ./ form-row -->
<div class="form-row">   
    <div class="col-md-4 mb-3"> 
        <div class="class_room_loader"></div>     
   </div>    <!-- ./ col-md-4 -->
   
    <div class="col-md-4 mb-3">
      <label for="title" class=""> Level Category </label>
       <select name="level_categ" class="form-control" required="">
            <option value=""  > ... </option>                                
           @foreach($level_categs as $categ)
            <option value="{{$categ['id']}}" @selected($student['level_category_admitted']==$categ['id']) >{{ $categ['name']}} Class </option>   
           @endforeach
        </select>
      <div class="invalid-feedback">
         Select Level Category
      </div>
   </div>    <!-- ./ col-md-4 -->
   
    <div class="col-md-4 mb-3">
      <label for="title" class=""> Date Admitted </label>
      <input type="text" value="{{ $student['date_admitted'] ?? Carbon::now()}}" name="date_admitted" class="form-control datepicker bg-white" required="" />           
      <div class="invalid-feedback">
         Select Date Admitted
      </div>
   </div>    <!-- ./ col-md-4 -->
    
</div>
<!-- form-row-->
 