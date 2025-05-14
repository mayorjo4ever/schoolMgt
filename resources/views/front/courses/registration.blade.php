<?php 
    use App\Models\Term; 
    use App\Models\Level; 
    use App\Models\ClassRoom; 
    use App\Models\LevelCategory; 
    use App\Models\Subject; 
    use Carbon\Carbon;

?>
@extends('front.arch_layouts.layout')
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
        <div class="col-md-12"> 
           @include('admin.arch_widgets.alert_message')
          
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">{{$page_info['title']}} &nbsp; &nbsp;   <center>  <div id="countdown"></div> <input id="countdown_date" type="hidden" value="{{$time_schedule['end_date']}}" /> </center>  </div>
            <div class="card-body"> 
                <div class="table">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="">
                                <th class="table-primary text-uppercase">Registration Number </th> <th class="text-uppercase">  {{$me->regno}} </th>                                
                                <th class="table-primary"> NAME </th> <th>  {{$me->name}} </th>                                
                            </tr>
                            <tr class="">
                                <th class="table-primary">CURRENT SESSION </th> <th>  {{$calendar->current_session}} </th>
                                <th class="table-primary">CURRENT TERM</th> <th class="text-uppercase">{{ Term::name($calendar->current_term)}} </th>                                
                            </tr>
                            <tr class="bg-light text-dark">
                                <th class="table-primary"> MY CURRENT LEVEL</th>  <th>  {{Level::name($me->current_level_id) }} : {{ ClassRoom::name($me->current_class_room_id)}} </th>                                 
                                <th class="table-primary">CLASS - CATEGORY :</th>
                                <th class="text-uppercase">{{ LevelCategory::name($me->current_level_category_id)}} </th>
                            </tr>
                        </thead>
                    </table>
                </div>  <!-- div table -->
                
                <h6 class="mt-3 mb-3 title text-capitalize text-justify font-weight-600">select below the  list of registrable courses... 
                    &nbsp; <span class="text-danger font-weight-700"> And Note That: Minimum Registrable Courses is 8 </span>
                </h6>
                
                
                <form class="" id="studentCourseForm" action="{{url('student/course-registration')}}"  method="post">@csrf
                   
                    @if(Carbon::now() < Carbon::parse($time_schedule['end_date']))
                    
                    <input name="session" id="session" type="hidden" value="{{$calendar->current_session }}" />
                    <input name="student" id="student" type="hidden" value="{{$me->id }}" />
                    <input name="regno" id="regno" type="hidden" value="{{$me->regno }}" />
                    <input name="level" id="level" type="hidden" value="{{$me->current_level_id }}" />
                    <input name="classroom" id="classroom" type="hidden" value="{{$me->current_class_room_id }}" />
                    <input name="level_categ" id="level_categ" type="hidden" value="{{$me->current_level_category_id }}" />
                    
                    <div class="table">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th class="text-center"> S/N </th>
                                <th class="text-uppercase">CODE / TITLE </th>
                            </tr>
                        </thead>
                        <tbody><?php $n = 1; $my_level_id = $me->current_level_id;  ?>
                            @foreach($def_courses as $subject_id=>$levels)
                            <?php $def_levels = explode(",", $levels); ## defined levels for the subject 
                            if(in_array($my_level_id, $def_levels)) {
                            ?>
                            <tr>
                                <td class="text-center"> {{$n}} </td>
                                <td> 
                                    <div class="custom-checkbox custom-control custom-control-inline">
                                        <input type="checkbox" name="subjects[]" @if(in_array($subject_id,$mySavedCourses)) checked="" @endif value="{{$subject_id}}" data-subject="{{$subject_id}}" id="custom_{{$subject_id}}" class="courses-custom custom-control-input" onclick="count_selected_courses()" > 
                                        &nbsp; &nbsp; 
                                        
                                        <label class="custom-control-label" for="custom_{{$subject_id}}">
                                        {{ Subject::subjectName($subject_id) }} 
                                        </label>
                                    </div>
                                    
                                    </td>
                            </tr>
                            <?php $n++; 
                            
                            } ## end if in array ?>
                            
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="w-100 btn-primary btn-lg ladda-button " data-style="expand-right"> Register &nbsp;<span class="tot-subject">0</span> &nbsp; Courses </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>  <!-- div table -->
                @endif 
               </form>
            </div>  <!-- ./ card-body -->              
        </div>
    </div>
</div>
 
@endsection 
