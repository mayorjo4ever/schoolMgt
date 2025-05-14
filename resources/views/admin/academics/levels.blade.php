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
            <div class="card-header">All Academic Levels
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
                @can('edit-levels')<th>Edit / Delete </th>@endcan
                <th>Last Updated </th>
            </tr>
            </thead>
            <tbody> @foreach($acad_levels as $level )
            <tr>
                <td class="text-muted pl-4"># {{ $level['id']}} </td>
                <td> {{ $level['name']}} </td> 
               @can('edit-levels') <td >
                    <a class="" role_id="{{ $level['id']}}" href="{{url('admin/add-edit-level/'.$level['id']) }}">
                        <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>                        
                </td>@endcan
                <td> {{ \Carbon\Carbon::parse($level['updated_at'])->diffForHumans()}}</td>
                </tr>
                    @endforeach
                </tbody>
        </table>
        </div>
        </div>

              

        </div>
    </div>

@endsection               