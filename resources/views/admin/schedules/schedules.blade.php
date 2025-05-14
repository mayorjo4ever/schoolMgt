<?php 
use App\Models\Subject;
?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
              @if(Session::has('success_message'))
                <div class="alert alert-success fade show " role="alert"> 
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <span class="pe-7s-check pe-2x"></span> &nbsp;&nbsp; <strong> {{Session::get('success_message')}} </strong> 
                </div>
              @endif
             
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">Available schedules
                <!--<div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Last Week</button>
                            <button class="btn btn-focus">All Month</button>
                    </div>
                </div> -->
            </div>
        <div class="table-responsive  mt-2 pt-2 ">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover dataTable">
            <thead>
            <tr>
                <th class="pl-4"># ID </th> 
                <th >Subject </th>
                <th >Pape Type</th>
                <th >Time </th>
                <th >Enrolled Students </th>
                <th >Status</th>
                <th>Edit  </th>
                <th>Last Updated </th>
            </tr>
            </thead>
            <tbody> @foreach($schedules as $schedule )
            <tr>
                <td class="text-muted pl-4"># {{ $schedule['id']}} </td>
                <td> {{ Subject::subjectName($schedule['subject_id'])}} </td> 
                <td class="text-capitalize"> {{ $schedule['paper_type']}} </td>                 
                <td> {{  timeSchedule( $schedule['hours'] , $schedule['minutes']) }}  </td> 
                <td>  
                      {{ empty($schedule['users']) ? 0 : count($schedule['users']) }}
                      &nbsp; &nbsp; 
                      <a href="{{url('admin/schedules/'.$schedule['id'])}}" target="_blank"> <span class="pe-7s-users pe-2x"></span> </a>
                    </td> 
                <td>
                         @if($schedule['status']==1)                                     
                            <a class="updateScheduleStatus" id="schedule_id-{{ $schedule['id']}}" schedule_id="{{ $schedule['id']}}" href="javascript:void(0)">
                                <i class="pe-7s-check pe-2x font-weight-bold text-success " status="active"></i> </a>
                           @else <a class="updateScheduleStatus" id="schedule_id-{{ $schedule['id']}}" schedule_id="{{ $schedule['id']}}" href="javascript:void(0)">
                              <i class="pe-7s-attention pe-2x  text-danger font-weight-bold"  status="inactive"></i></a>
                          @endif
                </td>
                <td >
                        <a class="" schedule_id="{{ $schedule['id']}}" href="{{url('admin/add-edit-schedule/'.$schedule['id']) }}">
                            <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>
                        

                </td>
                <td> {{ \Carbon\Carbon::parse($schedule['updated_at'])->diffForHumans()}}</td>
                </tr>
                    @endforeach
                </tbody>
        </table>
        </div>

        </div>
    </div>
</div>

@endsection 