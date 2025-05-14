<?php 
   use App\Models\Subject;
   ?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-lg-12">
     @include('admin.arch_widgets.alert_message')
       
     @include('admin.student_result.result_view_tab_header')   
     
     <div class="tab-content">
        @include('admin.student_result.manual_search_tabs_contents')              
        @include('admin.student_result.wizards_search_tabs_contents')              
    </div> <!-- /. tab-content -->
                 
   </div>
   <!-- col-lg-12 --> 
</div>
<!-- row -->  
@endsection
 