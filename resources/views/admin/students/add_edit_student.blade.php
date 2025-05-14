<?php 
   use App\Models\Subject;
   ?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-lg-10">
      
       @include('admin.arch_widgets.alert_message')
       
      <div class="col-md-12  float-left">
         <div class="main-card mt-0 pt-0 mb-4 pb-0 card">
            <div class="card-header mb-0"> {{$page_info['title']}}  </div> 

            <div class="card-body">
               <form id="new-student-form" class="needs-validation" method="post"  action="javascript:void(0)">@csrf 
                <input type="hidden" name="stud_id" id="stud_id" value="{{base64_encode($student['id'])}}" />
                @include('admin.students.stud_basic_info_form') 
                @include('admin.students.stud_admission_info_form') 
                @include('admin.students.stud_profile_image_form') 
              </form>  
               
            </div>
            <!-- card-body --> 
         </div>
         <!-- main-card --> 
      </div>
      <!-- col-md-7 -->
    
   </div>
   <!-- col-lg-12 --> 
</div>
<!-- row --> 
@endsection
