<?php 
   use App\Models\Subject;
   ?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-lg-12">
     @include('admin.arch_widgets.alert_message')
      
      <form class="needs-validation" novalidate  id="studentForm" @if(!empty($admin['id'])) action="{{url('admin/add-edit-staff/'.$admin['id'])}}" @else action="{{url('admin/add-edit-staff')}} " @endif  method="post">@csrf
      
      <div class="col-md-12  float-left">
         <div class="main-card mt-0 pt-0 mb-4 pb-4 card">
            <div class="card-header"> {{$page_info['title']}}  </div>
            <div class="card-body">
                
               @include('admin.staff.profile_form')
                              
               <h6 class="card-title">Activities and roles  </h6>
               
               @include('admin.staff.staff_role_selection_form')
               
               <div class="form-row">
                  <div class="col-md-12 mb-3"> &nbsp;                        
                     <button class="mt-2 btn btn-primary btn-lg w-100  subject-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Admin Info  </strong></button>
                  </div>
               </div>
               <!-- form-row-->
             
            </div>
            <!-- card-body --> 
         </div>
         <!-- main-card --> 
      </div> <!-- col-md-7 -->
                     
     </form> 
   </div>
   <!-- col-lg-12 --> 
</div>
<!-- row --> 
@endsection
