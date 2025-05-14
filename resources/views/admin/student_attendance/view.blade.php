<?php 
   use App\Models\Subject;
   ?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-lg-12">
       
     @include('admin.arch_widgets.alert_message')
       
     @include('admin.student_attendance.display_form')                        
     
   </div>
   <!-- col-lg-12 --> 
</div>
<!-- row -->  
@endsection
 