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
                <form id="" class="needs-validation" novalidate  action="{{url('admin/student-course-registration-settings')}}"  method="post">@csrf
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label for="title" class="font-weight-bold">Current Session </label>
                            <select name="reg_session" id="reg_session" class="form-control" required="">
                                <option value=""  > ... </option>                                
                                @foreach($sessions as $sess)
                                <?php $sess = $sess."/".($sess+1);?>
                                <option value="{{$sess}}" @selected($calendar['current_session']==$sess)> {{$sess}} </option> 
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                               Provide Current Session
                            </div>
                         </div> 
                        
                        <div class="col-md-5 mb-2">
                            <label for="title"  class="font-weight-bold text-capitalize">  Who are to register </label>
                            <select multiple="" name="to_reg[]" id="to_reg" class="form-control" required="">
                                <?php  $applicable_to = explode(',',$time_schedule['applicable_to']); ?>
                                <option value="0" @selected(in_array(0,$applicable_to))> All Student </option>                                
                                @foreach($levels as $level)                                 
                                <option value="{{$level['id']}}" @selected(in_array($level['id'],$applicable_to)) > {{$level['name']}} </option> 
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                              Select Whom To Register
                            </div> 
                         </div> 
                        
			<div class="col-md-3 mb-2">
                            <label for="title"  class="font-weight-bold"> Last Registration Date </label>
                            <input type="text" name="last_reg_date" id="" class="form-control bg-white datepicker"  placeholder=" Term Ends "  @if(!empty($calendar['term_ends'])) value="{{$time_schedule['end_date']}}" @else value="{{old('end_date')}}" @endif required >
                            <div class="invalid-feedback">
                               Provide Last 
                            </div>
                         </div>  
                        
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
                    <tr>
                      <td colspan="2">  <center> <span class="font-weight-bold mb-2"> To End In :</span> <div id="countdown"></div> <input id="countdown_date" type="hidden" value="{{$time_schedule['end_date']}}" /> </center> </td> 
                    </tr> 
                </table>
            </div>
        </div>
    </div>
</div>

@endsection 