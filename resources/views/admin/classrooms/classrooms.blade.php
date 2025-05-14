@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
            
            @include('admin.arch_widgets.alert_message')
            
            <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">Available Class Rooms
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
                <th>Name</th>                              
                <th>Academic Level</th>                              
                <th>Student Capacity </th>                              
                @can('edit-classroom')<th>Edit / Delete </th>@endcan
                <th>Last Updated </th>
            </tr>
            </thead>
            <tbody> @foreach($classrooms as $classroom )
            <tr>
                <td class="text-muted pl-4"># {{ $classroom['id']}} </td>
                <td> {{ $classroom['name']}} </td> 
                <td> {{ $levels[$classroom['level_id']]}} </td> 
                <td> {{ $classroom['capacity']}} </td> 
               @can('edit-classroom') <td >
                    <a class="" class_id="{{ $classroom['id']}}" href="{{url('admin/add-edit-classroom/'.$classroom['id']) }}">
                        <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>                        
                </td>@endcan
                <td> {{ \Carbon\Carbon::parse($classroom['updated_at'])->diffForHumans()}}</td>
                </tr>
                    @endforeach
                </tbody>
        </table>
        </div>
        </div>

              

        </div>
    </div>

@endsection               

   