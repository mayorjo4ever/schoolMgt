<?php 
   use App\Models\Subject;
   ?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-lg-12">
     @include('admin.arch_widgets.alert_message')
     <form class="needs-validation" novalidate id="studentSearchForm"  onsubmit="handleLecturerStudentSearch()" action="javascript:void(0)" method="post">@csrf
      
      <div class="col-md-12  float-left">
         <div class="main-card mt-0 pt-0 mb-4 pb-4 card">            
            <div class="card-body">
                                 
               @include('admin.staff.students.student_filter_form')              
              
               <div id="student-list"></div>
               
             </div>
            <!-- card-body  --> 
         </div>
         <!-- main-card --> 
      </div> <!-- col-md-7 -->
                     
     </form> 
   </div>
   <!-- col-lg-12 --> 
</div>
<!-- row --> 
@endsection
 