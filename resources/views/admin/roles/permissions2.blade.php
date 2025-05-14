@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
          @include('admin.arch_widgets.alert_message')
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">Available Permissions
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
                <th >Name</th>
                <th >Guard Name </th>                
                <th>Edit / Delete </th>
                <th>Last Updated </th>
            </tr>
            </thead>
            <tbody> @foreach($permissions as $permission )
            <tr>
                <td class="text-muted pl-4"># {{ $permission['id']}} </td>
                <td> {{ $permission['name']}} </td> 
                <td> {{ $permission['guard_name']}} </td>                
                <td >
                    <a class="" permission_id="{{ $permission['id']}}" href="{{url('admin/add-edit-permission/'.$permission['id']) }}">
                        <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>                        
                </td>
                <td> {{ \Carbon\Carbon::parse($permission['updated_at'])->diffForHumans()}}</td>
                </tr>
                    @endforeach
                </tbody>
        </table>
        </div>

        </div>
    </div>
</div>

@endsection 