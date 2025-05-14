<?php
    use Carbon\Carbon;
?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
    <style>
        .time-table tr td {
            font-size: 1em;
            text-align: center; 
            font-weight: bold; 
        }
        .time-table tr td > span {
             font-size: 0.8em; font-weight: normal;
             text-transform: none;              
        }
        
    </style>
        <div class="col-md-12"> 
         @include('admin.arch_widgets.alert_message')
         
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">{{$page_info['title']}} </div>
            <div class="card-body">
                <form id="" class="needs-validation" novalidate  action="{{url('admin/result-uploads-settings')}}"  method="post">@csrf
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="title" class="font-weight-bold">Current Session </label>
                            <select name="acad_session" id="acad_session" class="form-control" required="">
                                <option value=""  > ... </option>                                
                                @foreach($sessions as $sess)
                                <?php $sess = $sess."/".($sess+1);?>
                                <option value="{{$sess}}" @selected($calendar['current_session']==$sess)> {{$sess}} </option> 
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                               Provide Current Session
                            </div>
                         </div> <!-- ./ col-md-3  -->
                        
                        <div class="col-md-3 mb-2">
                            <label for="title"  class="font-weight-bold text-capitalize">Which Academic Terms </label>
                            <select multiple="" name="terms[]" id="acad_terms" class="form-control" required="">
                                <?php  $applicable_to = explode(',',$time_schedule['applicable_to']); ?>  
                                @foreach($terms as $term)                                 
                                <option value="{{$term['id']}}" @selected(in_array($term['id'],$applicable_to))> {{$term['name']}} </option> 
                                @endforeach
                            </select> <?php # print_r($applicable_to); ?>
                            <div class="invalid-feedback">
                              Select Which Academic Terms 
                            </div> 
                         </div> <!-- ./ col-md-3  -->
                        
                        <div class="col-md-3 mb-2">
                            <label for="title"  class="font-weight-bold"> Start Date </label>
                            <input type="text" name="start_date" id="start_date" class="form-control bg-white datepicker"  placeholder=" Start Date "  @if(!empty($time_schedule['start_date'])) value="{{$time_schedule['start_date']}}" @else value="{{old('start_date')}}" @endif required >
                            <div class="invalid-feedback">
                               Provide Start Date 
                            </div>
                         </div>  <!-- ./ col-md-3  -->
                        
			<div class="col-md-3 mb-2">
                            <label for="title"  class="font-weight-bold"> End Date </label>
                            <input type="text" name="end_date" id="end_date" class="form-control bg-white datepicker"  placeholder=" End Date"  @if(!empty($time_schedule['end_date'])) value="{{$time_schedule['end_date']}}" @else value="{{old('end_date')}}" @endif required >
                            <div class="invalid-feedback">
                               Provide End Date 
                            </div>
                         </div>  <!-- ./ col-md-3  -->
                        
                    </div> <!-- ./ form-row  -->
                    <div class="form-row">
                      <div class="col-md-12 mb-3">     &nbsp;                        
                           <button class="mt-1 btn btn-primary btn-lg w-100 course-reg-btn ladda-button" data-style="expand-right" type="submit"> <strong>Update Registration Settings  </strong></button>
                         </div>
                    </div> <!-- ./ form-row  -->
               </form>
            </div>  <!-- ./ card-body -->   
            <div class="card-footer">
                <table class=" table table-bordered text-dark mt-0 font-size-lg text-capitalize font-weight-normal"> 
                    @if(Carbon::now() < $time_schedule['start_date'] )
                    <tr>
                      <td colspan="2">  <center> <span class="font-weight-bold mb-2"> To Start In :</span> <div id="countdown"></div> <input id="countdown_date" type="hidden" value="{{$time_schedule['start_date']}}" /> </center> </td> 
                    </tr> 
                    @else 
                     <tr>
                         <td colspan="2">  <center><span class="font-weight-bold mb-2"> To End In :</span> <div id="countdown"></div> <input id="countdown_date" type="hidden" value="{{$time_schedule['end_date']}}" /> </center> </td> 
                    </tr> 
                    @endif
                </table>  
            </div>
        </div>
    </div>
</div>

@endsection 