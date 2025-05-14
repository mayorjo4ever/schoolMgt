@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
           @include('admin.arch_widgets.alert_message')
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">{{$page_info['title']}} </div>
            <div class="card-body">
                <form class="needs-validation" novalidate id="assignRoleForm" action="javascript:void(0)" onsubmit="handleRoleAssignment()" method="post">@csrf
                    <div class="form-row">                       
                        <div class="col-md-4 mb-3">
                            <label for="code" class="h6 font-weight-bold mb-3">Select A Staff </label>
                            <select name="admin-staff" id="admin-staff" onchange="loadStaffRoles()" class="form-control mb-3" required="">
                                <option value=""  > ... </option>
                               @foreach($admins as $admin)
                               <option value="{{$admin['id']}}" @if($admin['id']==$staff_id) selected="" @endif > {{$admin['title']." ".$admin['surname']." ".$admin['firstname']." ".$admin['othername']." / ".$admin['regno']}} </option>
                                @endforeach
                            </select> 
                            <div class="invalid-feedback">
                               Select A Staff
                            </div>
                            <span class="ajaxLoader bg-dark h2 ladda-button " data-style="expand-right"></span>
                         </div>
                        
                        <div class="col-md-4 mb-3 ml-2">
                            <label for="loader" class="h6 text-capitalize font-weight-bold mb-3">Select one or more roles </label>                              
                            <div id="role_list" class="position-relative form-group ml-4">
                               
                            </div> <!-- form-group -->
                             
                         </div> <!-- ./ col-md-4  -->
                        
                         <div class="col-md-3 mb-3">     &nbsp;                        
                           <button class="mt-2 btn btn-primary btn-lg w-100  assign-staff-role-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Updates </strong></button>
                         </div>
                    </div>
               </form>
            </div>  <!-- ./ card-body -->              
        </div>
    </div>
</div>

@endsection 