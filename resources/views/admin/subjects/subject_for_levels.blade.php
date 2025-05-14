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
         <div class="card-header">{{$page_info['title']}} </div>
         <div class="card-body">
            <label class="font-weight-bold text-uppercase"> Select one or more Levels </label> <br/>
            <form class="" novalidate id="rolePermForm" action="javascript:void(0)"  method="post">
               @csrf
               <div class="form-row">
                  @foreach($levels as $level)
                  <div class="col-md-2 mt-2 mb-2   table table-bordered ">
                     <div class="mt-2 mb-2">
                        <div class="custom-checkbox custom-control custom-control-inline">
                           <input type="checkbox" name="levels[]" value="{{$level['id']}}" id="custom_level_{{$level['id']}}" class="class-level-custom custom-control-input"  >
                           &nbsp; &nbsp; 
                           <label class="custom-control-label" for="custom_level_{{$level['id']}}">
                           {{$level['name']}}  </label>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  <div class="col-md-3 mb-3">
                     <label class="font-weight-bold text-uppercase"> Student Level Category </label>
                     <select name="level_category" id="level_category" class="form-control" required="
                        ">
                        <option value=""> --- </option>
                        @foreach($level_categories as $category)
                        <option value="{{$category['id']}}"> {{$category['name']}} </option>
                        @endforeach
                     </select>
                     <div class="invalid-feedback">
                        Provide Select  Level Category
                     </div>
                  </div>
                  <div class="col-md-3 mb-3">     &nbsp;                        
                     <button class="mt-2 btn btn-primary btn-lg w-100 level-subject-btn ladda-button" data-style="expand-right" type="submit"> <strong> Show Defined Courses  </strong></button>
                  </div>
               </div>
            </form>
            <div id="subjects-view">
            </div>
         </div>
         <!-- ./ card-body -->              
      </div>
   </div>
</div>
@endsection
