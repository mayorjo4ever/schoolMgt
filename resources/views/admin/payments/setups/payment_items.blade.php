<?php use Carbon\Carbon; ?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-lg-12">
     @include('admin.arch_widgets.alert_message')
     
      <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
       
          @include('admin.payments.setups.itemform')
         
        <p class=" mb-1 text-uppercase mt-4 title font-weight-700 text-lg text-center"> List of Payment Types </p>
        <x-table-action-pane title="Items" />
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered table-hover table-md dataTable">
                    <thead class="tble-dark">  <tr>
                        <th>S/N </th>
                        <th>Payment Name </th>                      
                        @can('modify-payment-items') <th>Status </th> @endcan                     
                        @can('edit-payment-items')<th>Edit </th>@endcan  
                        <th>Last Update </th>
                        </tr></thead> <tbody>
                    @foreach($all_pay_items as $n=>$pay_item)
                    <tr class=" {{ (!empty($payItem['id']) && $pay_item['id'] == $payItem['id']) ? 'table-warning' : '' }}  {{ ($pay_item['status']==1) ?' active':'inactive' }} " >
                        <td>{{$n+1}} </td>
                         <td>{{$pay_item['name'] }} </td>     
                         @can('modify-payment-items')
                         <td> 
                               @if($pay_item['status']==1)
                            <a class="updatePayItemStatus" id="pay_item_id-{{ $pay_item['id']}}" pay_item_id="{{ $pay_item['id']}}" href="javascript:void(0)">
                                <i class="pe-7s-check pe-2x font-weight-bold text-success " status="active"></i> Active </a>
                           @else <a class="updatePayItemStatus" id="pay_item_id-{{ $pay_item['id']}}" pay_item_id="{{ $pay_item['id']}}" href="javascript:void(0)">
                              <i class="pe-7s-attention pe-2x  text-danger font-weight-bold"  status="inactive"></i> Deleted </a>
                          @endif   &nbsp; &nbsp; <span class="pay_item_id-{{ $pay_item['id']}} ladda-button text-dark bg-dark" data-style="expand-right"></span>
                         </td>@endcan                      
                         @can('edit-payment-items') <td>  
                             <a class="" grade_id="{{ $pay_item['id']}}" href="{{url('admin/payment-items/'.$pay_item['id']) }}">
                            <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>                              
                            
                         </td> 
                        
                         @endcan 
                         <td> {{ Carbon::parse($pay_item['updated_at'])->diffForHumans() }} </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
           
      </div>
                 
   </div>
   <!-- col-lg-12 --> 
</div>
<!-- row -->  
@endsection