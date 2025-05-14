<?php 
# use App\Models\Subject;
## use App\Models\Level; 
## use App\Models\ClassRoom;
?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
            
           @include('admin.arch_widgets.alert_message')
          
           @include('admin.students.stud_search_form')
           
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">Available Students
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
                <th>Reg. No. </th>
                <th>Full Name </th>               
                <!--<th>Email </th>-->
                <th>Current Level </th>
                <th>Class Room </th>
                <th>Status</th>
                <th>Edit  </th>
                <th>Last Updated </th>
            </tr>
            </thead>
            <tbody> @foreach($students as $student )
            <tr>
                <td class="text-muted pl-4"># {{ $student['id']}} </td>
                <td class="text-uppercase"> {{ $student['regno']}} </td> 
                <td class="text-capitalize"> {{ $student['name']}} </td>                                 
                <!--<td>{{ $student['email']}} </td>--> 
                <td>{{$levels[$student['current_level_id']]}} </td> 
                <td> {{ $classrooms[$student['current_class_room_id']] }}</td> <?php # ?>
                <td>
                    @if($student['status']==1)                                     
                       <a class="updateStudentStatus" id="student_id-{{ $student['id']}}" student_id="{{ $student['id']}}" href="javascript:void(0)">
                           <i class="pe-7s-check pe-2x font-weight-bold text-success " status="active"></i> </a>
                      @else <a class="updateStudentStatus" id="student_id-{{ $student['id']}}" student_id="{{ $student['id']}}" href="javascript:void(0)">
                         <i class="pe-7s-attention pe-2x  text-danger font-weight-bold"  status="inactive"></i></a>
                     @endif
                </td>
                <td>
                    <a class="" student_id="{{ $student['id']}}" href="{{url('admin/add-new-student/'.$student['id']) }}">
                        <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>                       

                </td>
                <td> {{ \Carbon\Carbon::parse($student['updated_at'])->diffForHumans()}}</td>
                </tr>
                    @endforeach
                </tbody>
        </table>
        </div>

        </div>
    </div>
</div>

@endsection 