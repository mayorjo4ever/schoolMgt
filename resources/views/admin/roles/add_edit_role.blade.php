@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
            @include('admin.arch_widgets.alert_message')
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">{{$page_info['title']}} </div>
            <div class="card-body">
               <form class="needs-validation" novalidate id="subjectForm" @if(!empty($role['id'])) action="{{url('admin/add-edit-role/'.$role['id'])}}" @else action="{{url('admin/add-edit-role')}} " @endif  method="post">@csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="title">Role Name </label>
                            <input type="text" name="name" id="role-name" class="form-control"  placeholder="Role Name  "  @if(!empty($role['name'])) value="{{$role['name']}}" @endif required >
                            <div class="invalid-feedback">
                               Provide Role Name
                            </div>
                         </div>
                        <div class="col-md-4 mb-3">
                            <label for="code">Role Guard </label>
                            <select name="guard" class="form-control" required="">
                                <option value=""  > ... </option>
                                <option value="admin" @if($role['guard_name']=="admin") selected @endif > Admin </option>
                                <option value="student" @if($role['guard_name']=="student") selected @endif > Student </option>                                
                                <option value="web" @if($role['guard_name']=="web") selected @endif > Web </option>                                
                            </select> 
                            
                            <div class="invalid-feedback">
                               Provide Role Guard 
                            </div>
                         </div>
                         <div class="col-md-3 mb-3">     &nbsp;                        
                           <button class="mt-2 btn btn-primary btn-lg w-100  subject-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Role  </strong></button>
                         </div>
                    </div>
               </form>
            </div>  <!-- ./ card-body -->              
        </div>
    </div>
</div>

@endsection 