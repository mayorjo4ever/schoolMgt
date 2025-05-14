@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-md-12">
       @include('admin.arch_widgets.alert_message')
      <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
         <div class="card-header">{{$page_info['title']}} </div>
         <div class="card-body">
            <form id="subjectForm" @if(!empty($subject['id'])) action="{{url('admin/add-edit-subject/'.$subject['id'])}}" @else action="{{url('admin/add-edit-subject')}} " @endif  method="post">@csrf
            <div class="form-row">
               <div class="col-md-4 mb-3">
                  <label for="title">Subject Title </label>
                  <input type="text" name="title" id="subject-title" class="form-control"  placeholder="Subject Title  "  @if(!empty($subject['title'])) value="{{$subject['title']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Subject Title 
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label for="code">Subject Code </label>
                  <input type="text" name="code" id="subject-code" class="form-control"  placeholder="Subject Code" @if(!empty($subject['code'])) value="{{$subject['code']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Subject Code 
                  </div>
               </div>
               <div class="col-md-3 mb-3">     &nbsp;                        
                  <button class="mt-2 btn btn-primary btn-lg w-100  subject-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Subject  </strong></button>
               </div>
            </div>
            </form>
         </div>
         <!-- ./ card-body -->              
      </div>
   </div>
</div>
@endsection
