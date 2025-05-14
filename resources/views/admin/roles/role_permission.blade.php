@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
            @include('admin.arch_widgets.alert_message')
             
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">{{$page_info['title']}} </div>
            <div class="card-body">
               <form class="needs-validation" novalidate id="rolePermForm" action="javascript:void(0)"  method="post">@csrf
                    <div class="form-row">                       
                        <div class="col-md-4 mb-3">
                            <label for="code">Select A Role </label>
                            <select name="role" id="role" onchange="$('.role-perm-btn').click()" class="form-control" required="">
                                <option value=""  > ... </option>
                               @foreach($roles as $role)
                                <option value="{{$role['id']}}" > {{$role['name']}} </option>
                                @endforeach
                            </select> 
                            <div class="invalid-feedback">
                               Select A Role
                            </div>
                         </div>
                         <div class="col-md-3 mb-3">     &nbsp;                        
                           <button class="mt-2 btn btn-primary btn-lg w-100 role-perm-btn ladda-button" data-style="expand-right" type="submit"> <strong> Show Permissions  </strong></button>
                         </div>
                    </div>
               </form>
                <div id="permissions-view">
                    
                </div>
            </div>  <!-- ./ card-body -->              
        </div>
    </div>
</div>

@endsection 