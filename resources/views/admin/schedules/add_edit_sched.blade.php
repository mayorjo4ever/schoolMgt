<?php 
   use App\Models\Subject;
   ?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-lg-12">
      @if(Session::has('success_message'))
      <div class="alert alert-success fade show " role="alert"> 
         <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
         <span class="pe-7s-check pe-2x"></span> &nbsp;&nbsp; <strong> {{Session::get('success_message')}} </strong> 
      </div>
      @endif
      
      @if(Session::has('error_message'))
      <div class="alert alert-danger fade show " role="alert"> 
         <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
         <span class="pe-7s-attention pe-2x"></span> &nbsp;&nbsp; <strong> {{Session::get('error_message')}} </strong> 
      </div>
      @endif
      
      @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  <button type="button" class="close" data-dismiss="alert" > <span>&times </span> </button>
           </div>
           @endif
      
      <form id="scheduleForm" @if(!empty($schedule['id'])) action="{{url('admin/add-edit-schedule/'.$schedule['id'])}}" @else action="{{url('admin/add-edit-schedule')}} " @endif  method="post">@csrf
      
      <div class="col-md-7  float-left">
         <div class="main-card mt-0 pt-0 mb-4 pb-4 card">
            <div class="card-header"> {{$page_info['title']}}  </div>
            <div class="card-body">
               
               <div class="form-row">
                  <div class="col-md-6 mb-3">
                     <label for="title">Select Subject  </label>
                     <select name="subject" id="subject-title" class="form-control" required >
                        <option value="">Select Subject </option>
                        @foreach($subjects as $subject)
                        <option value="{{$subject['id']}}" @if($schedule['subject_id']==$subject['id']) selected="" @endif >{{$subject['code'] . " -> ". $subject['title'] }}</option>
                        @endforeach                            
                     </select>
                     <div class="invalid-feedback">
                        Provide Subject Title 
                     </div>
                  </div>
                  <!-- col-md-6 -->
                  <div class="col-md-6 mb-3">
                     <label for="title">Hours </label>
                     <select name="hours" id="hours" class="form-control" required >
                        <option value="">Select Hours </option>
                        <option value="0" @if($schedule['hours']==0) selected="" @endif >0 Hour </option>
                        @for($h=1; $h<=5; $h++) <option value="{{$h}}"  @if($schedule['hours']==$h) selected="" @endif >{{timeSchedule($h,0,true)}}</option>     @endfor 
                     </select>
                     <div class="invalid-feedback">
                        Provide Subject Code 
                     </div>
                  </div>
                  <!-- col-md-6 -->
               </div>
               <!-- ./ form-row --> 
               <div class="form-row">
                  <div class="col-md-6 mb-3">
                     <label for="title">Paper Type  </label>
                     <select name="paper_type" id="paper_type" class="form-control" required >
                        <option value="">Select Type </option>
                        <option value="test"  @if($schedule['paper_type']=='test') selected="" @endif>Test</option>
                        <option value="exam"  @if($schedule['paper_type']=='exam') selected="" @endif>Exam</option>                            
                     </select>
                     <div class="invalid-feedback">
                        Select Paper Type 
                     </div>
                  </div>
                  <!-- col-md-6 -->
                  <div class="col-md-6 mb-3">
                     <label for="title">Minutes </label>
                     <select name="minutes" id="minutes" class="form-control" required >
                        <option value="">Select Minutes </option>
                        <option value="0" @if($schedule['minutes']==0) selected="" @endif >0 Minute </option>
                        @for($m=1; $m<=59; $m++) <option value="{{$m}}"  @if($schedule['minutes']==$m) selected="" @endif>{{timeSchedule(0,$m,true)}} </option> @endfor 
                     </select>
                     <div class="invalid-feedback">
                        Provide Subject Code 
                     </div>
                  </div>
               </div>
               <!-- ./ form-row-->
               
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                      <label for="title">Available Questions &nbsp;  <span class="ajaxLoader bg-dark h2 ladda-button" data-style="expand-right"></span> </label> 
                      <input type="text" name="allqtn" id="allqtn" class="form-control bg-white" readonly="" required="" >
                     <div class="invalid-feedback">                       
                     </div>
                  </div>
                  <!-- col-md-6 -->
                  <div class="col-md-6 mb-3">
                     <label for="title">Maximum Questions Allowed &nbsp;  <span class=" h2 " data-style="expand-right"></span> </label>
                     <input type="text" name="maxqtn" id="maxqtn" value="{{$schedule['max_qtn']}}" class="form-control" required="">
                     <div class="invalid-feedback">                       
                     </div>
                  </div>
               </div>
               <!-- form-row-->
              
              
               
               <div class="form-row">
                  <div class="col-md-12 mb-3"> &nbsp;                        
                     <button class="mt-2 btn btn-primary btn-lg w-100  subject-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Schedule  </strong></button>
                  </div>
               </div>
               <!-- form-row-->
             
            </div>
            <!-- card-body --> 
         </div>
         <!-- main-card --> 
      </div> <!-- col-md-7 -->
      
      <div class="col-md-5 float-left">
         <div class="main-card  mt-0 pt-0 mb-4 pb-4 card">
            <div class="card-header"> Enrolled Students  </div>
            <div class="card-body">
               
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <div>
                        <div class="custom-checkbox custom-control custom-control-inline">
                            <input name="remove_prev_stud" value="yes" type="checkbox" id="remove_prev_stud" class="custom-control-input">
                                <label class="custom-control-label" for="remove_prev_stud">Remove Previous Students </label>
                        </div>
                       </div>
                </div> <!-- col-md-12-->
                   
                  <div class="col-md-12 mb-3">                      
                     <label for="title">Select Students  </label>
                     <select name="students[]" id="students" class="form-control" multiple="" style="height:210px " required >                        
                        @foreach($users as $user)
                        <option value="{{$user['id']}}" @if(in_array($user['id'],$schedusers)) selected="" @endif >{{$user['surname'] . ", ". $user['firstname']. " ". $user['othername'] }}</option>
                        @endforeach                            
                     </select>
                     <div class="invalid-feedback">
                        Provide Subject Title 
                     </div>
                  </div>
                  <!-- col-md-12 -->                  
               </div>
               <!-- ./ form-row --> 
              </div>
            <!-- card-body --> 
         </div>
         <!-- main-card -->         
          
      </div>
      
      
     </form> 
   </div>
   <!-- col-lg-12 --> 
</div>
<!-- row --> 
@endsection
