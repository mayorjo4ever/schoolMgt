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
               <form id="subjectForm" enctype="multipart/form-data" action="{{url('admin/questions/read-excel')}}" method="post">@csrf
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="title">Select Subject  </label>
                            <select name="subject" id="subject-title" class="form-control" required >
                                <option value="">Select Subject </option>
                                @foreach($subjects as $subject)
                                 <option value="{{$subject['id']}}">{{$subject['code'] . " -> ". $subject['title'] }}</option>
                            @endforeach
                            
                            </select>
                            <div class="invalid-feedback">
                               Provide Subject Title 
                            </div>
                         </div>
                        <div class="col-md-3 mb-3">
                            <label for="title">Select Question Type  </label>
                            <select name="type" id="subject-type" class="form-control" required >
                                <option value="">... </option>                                
                                <option value="test">Test </option>                                
                                 <option value="exam">Exam </option>                                                        
                            </select>
                            <div class="invalid-feedback">
                               Provide Question TYpe 
                            </div>
                         </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="code">Browse Question </label>
                            <input type="file" name="file" class="form-control" required >
                            <div class="invalid-feedback">
                               Provide Subject Code 
                            </div>
                         </div>
                         <div class="col-md-3 mb-3">     &nbsp;                        
                           <button class="mt-2 btn btn-primary btn-lg w-100  subject-btn ladda-button" data-style="expand-right" type="submit"> <strong> Upload Question </strong></button>
                         </div>
                    </div>
               </form>
            </div>  <!-- ./ card-body -->              
        </div>
    </div>
</div>

@endsection 