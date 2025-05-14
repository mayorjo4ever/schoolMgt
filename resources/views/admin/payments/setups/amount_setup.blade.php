<?php use Carbon\Carbon; ?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-lg-12">
     @include('admin.arch_widgets.alert_message')
     
      <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
         @include('admin.payments.setups.amount_setup_form')
         
        <div class="card-body">          
        <p class=" mb-1 text-uppercase title font-weight-700 text-lg"> {{$subTitle ?? ""}} </p>
        
        <div class="payment_setup_continuation"></div>
        
         
        </div>
           
      </div>
                 
   </div>
   <!-- col-lg-12 --> 
</div>
<!-- row -->  
@endsection