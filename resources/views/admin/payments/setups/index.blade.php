<?php use Carbon\Carbon; ?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-lg-12">
     @include('admin.arch_widgets.alert_message')
     
      <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
       
          @include('admin.payments.setups.typeform')
         
        <p class=" mb-1 text-uppercase mt-4 title font-weight-700 text-lg text-center"> List of Payment Types </p>
         <x-table-action-pane title="Items" />
        <div class="card-body">
           
            <div class="table">
                <table class="table table-bordered table-sm dataTable">
                    <thead>  <tr>
                        <th>S/N </th>
                        <th>Payment Name </th>
                        <th>Payment Code </th>
                        <th>Status </th>                        
                        <th>Actions </th>
                        <th>Last Update </th>
                        </tr></thead> <tbody>
                    @foreach($all_pay_types as $n=>$pay_type)
                   <tr class=" {{ (!empty($payType['id']) && $pay_type['id'] == $payType['id']) ? 'table-warning' : '' }}  {{ ($pay_type['status']==1) ?' active':'inactive' }} " >
                        <td>{{$n+1}} </td>
                         <td>{{$pay_type['name'] }} </td>
                         <td>{{$pay_type['code'] }} </td>
                         @can('modify-payment-items')
                         <td> 
                               @if($pay_type['status']==1)
                            <a class="updatePayTypeStatus" id="pay_type_id-{{ $pay_type['id']}}" pay_type_id="{{ $pay_type['id']}}" href="javascript:void(0)">
                                <i class="pe-7s-check pe-2x font-weight-bold text-success " status="active"></i> Active </a>
                           @else <a class="updatePayTypeStatus" id="pay_type_id-{{ $pay_type['id']}}" pay_type_id="{{ $pay_type['id']}}" href="javascript:void(0)">
                              <i class="pe-7s-attention pe-2x  text-danger font-weight-bold"  status="inactive"></i> Deleted </a>
                          @endif   &nbsp; &nbsp; <span class="pay_type_id-{{ $pay_type['id']}} ladda-button text-dark bg-dark" data-style="expand-right"></span>
                         </td>@endcan                       
                         <td> <a class="" grade_id="{{ $pay_type['id']}}" href="{{url('admin/setup-payment-types/'.$pay_type['id']) }}">
                            <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>
                            
                            &nbsp; &nbsp; 
                           <a class="confirmDelete" title="{{ $pay_type['name']}}" module="payment-types" moduleid="{{ $pay_type['id']}}" href="javascrpt:void(0)">
                          <i class="pe-7s-trash pe-2x text-danger" ></i></a>
                         </td>
                         <td> {{ Carbon::parse($pay_type['updated_at'])->diffForHumans() }} </td>  
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