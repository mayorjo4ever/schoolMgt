<?php 
   use App\Models\Subject;
   ?>
@extends('admin.arch_layouts.layout')
@section('content')

<style>
        .time-table tr td {
            font-size: 1.2em;
            text-align: center; 
            font-weight: bold; 
        }
        .time-table tr td > span {
             font-size: 0.9em; font-weight: normal;
             text-transform: none;              
        }
        
    </style>
    
<div class="row mt-0 pt-0">
   <div class="col-lg-12">
     @include('admin.arch_widgets.alert_message')                  
     
     @include('admin.staff.students.result_upload_tabs_header')   
     
     <div class="tab-content">
        @include('admin.staff.students.manual_result_upload_tabs_contents')              
        @include('admin.staff.students.bulk_result_upload_tabs_contents')              
    </div> <!-- /. tab-content -->
                 
   </div>
   <!-- col-lg-12 --> 
</div>
<!-- row --> 


@endsection
 