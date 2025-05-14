@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
           @include('admin.arch_widgets.alert_message')
             
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">{{$page_info['title']}} </div>
            <div class="card-body">
               <form class="needs-validation" novalidate id="subjectForm" @if(!empty($permission['id'])) action="{{url('admin/add-edit-permission/'.$permission['id'])}}" @else action="{{url('admin/add-edit-permission')}} " @endif  method="post">@csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="title">Permission Name </label>
                            <input type="text" name="name" id="permission-name" class="form-control"  placeholder="Permission Name  "  @if(!empty($permission['name'])) value="{{$permission['name']}}" @endif required >
                            <div class="invalid-feedback">
                               Provide Permission Name
                            </div>
                         </div>
                        
                        <div class="col-md-4 mb-3">                           
                            <label for="code">Permission Category </label>
                            <select name="category" class="form-control text-capitalize" required="">
                                <option value=""  > ... </option>
                                @foreach($categories as $category)
                                    <option value="{{$category}}" @selected($permission['category']==$category) > {{$category}} </option>
                                @endforeach
                            </select>
                            
                            <div class="invalid-feedback">
                               Provide Permission Guard 
                            </div>
                         </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="code">Permission Guard </label>
                            <select name="guard" class="form-control" required="">
                                <option value=""  > ... </option>
                                <option value="admin" @if($permission['guard_name']=="admin") selected @endif > Admin </option>
                                <option value="student" @if($permission['guard_name']=="student") selected @endif > Student </option>
                                <option value="web" @if($permission['guard_name']=="web") selected @endif > Web </option>                                
                            </select>
                            
                            <div class="invalid-feedback">
                               Provide Permission Guard 
                            </div>
                         </div>
                        
                         <div class="col-md-3 mb-3">     &nbsp;                        
                           <button class="mt-2 btn btn-primary btn-lg w-100  permission-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Permission  </strong></button>
                         </div>
                    </div>
               </form>
            </div>  <!-- ./ card-body -->              
        </div>
    </div>
</div>

@endsection 