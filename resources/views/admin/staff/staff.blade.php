<?php 
 use Spatie\Permission\Models\Role;
?>
@extends('admin.arch_layouts.layout')
@section('content')


<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
              
	 @include('admin.arch_widgets.alert_message')
			  
        <div class="main-card ml-4 pl-4 mt-1 pt-3 mb-4 pb-4 mr-4 pr-4 card">
            <!--<div class="card-header">Available Staff
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Last Week</button>
                            <button class="btn btn-focus">All Month</button>
                    </div>
                </div> 
            </div>-->
		<!--
        <div class="table-responsive  mt-2 pt-2 ">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover dataTable">
            <thead>
            <tr>
                <th class="pl-4"># ID </th> 
                <th>Title </th>
                <th>Surname </th>
                <th>First Name </th>
                <th>Other Name </th>
                <th>Email </th>
                <th>Role</th>                
				@can('create-admin')<th>Status</th>
                <th>Edit  </th>@endcan
                <th>Last Updated </th>
            </tr>
            </thead>
            <tbody> @foreach($admins as $admin )
            <tr>
                <td class="text-muted pl-4"># {{ $admin['id']}} </td>
                <td class="text-capitalize"> {{ $admin['title']}} </td> 
                <td class="text-uppercase"> {{ $admin['surname']}} </td> 
                <td class="text-capitalize"> {{ $admin['firstname']}} </td>                 
                <td class="text-capitalize"> {{  $admin['othername'] }}  </td> 
                <td>{{ $admin['email']}} </td> 
                <td>{{   adminRoles($admin['id']) }}                  
                 @can('assign-role')
                    &nbsp; &nbsp; 
                     <a title="Assign New Role" admin_id="{{ $admin['id']}}" href="{{url('admin/staff/assign-role/'.$admin['id']) }}">
                     <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>  
                    @endcan
                </td> 
                @can('create-admin')<td>
                    @if($admin['status']==1)                                     
                       <a class="updateStudentStatus" id="admin_id-{{ $admin['id']}}" admin_id="{{ $admin['id']}}" href="javascript:void(0)">
                           <i class="pe-7s-check pe-2x font-weight-bold text-success " status="active"></i> </a>
                      @else <a class="updateStudentStatus" id="admin_id-{{ $admin['id']}}" admin_id="{{ $admin['id']}}" href="javascript:void(0)">
                         <i class="pe-7s-attention pe-2x  text-danger font-weight-bold"  status="inactive"></i></a>
                     @endif
                </td> 
                <td>
                    <a class="" admin_id="{{ $admin['id']}}" href="{{url('admin/add-edit-staff/'.$admin['id']) }}">
                        <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>                          
                      
                </td>@endcan
                <td> {{ \Carbon\Carbon::parse($admin['updated_at'])->diffForHumans()}}</td>
                </tr>
                    @endforeach
                </tbody>
        </table>
        </div>-->
	
		@include('admin.staff.profile')
		
        </div>
    </div>
</div>



@endsection 