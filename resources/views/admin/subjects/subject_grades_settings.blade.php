@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-md-12">
       @include('admin.arch_widgets.alert_message')
      <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
         <div class="card-header"> Add / Update Grade </div>
         <div class="card-body">
            <form id="subjectGradeForm" @if(!empty($grade['id'])) action="{{url('admin/subject-grade-settings/'.$grade['id'])}}" @else action="{{url('admin/subject-grade-settings')}} " @endif  method="post">@csrf
            <div class="form-row">
               <div class="col-md-2 mb-3">
                  <label for="title">Mark From </label>
                  <input type="text" name="mark_from" id="mark_from" class="form-control"  placeholder="e.g 0"  @if(!empty($grade['mark_from'])) value="{{$grade['mark_from']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Mark From
                  </div>
               </div>
               <div class="col-md-2 mb-3">
                  <label for="code">Mark To </label>
                  <input type="text" name="mark_to" id="mark_to" class="form-control"  placeholder="e.g. 39" @if(!empty($grade['mark_to'])) value="{{$grade['mark_to']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Mark To
                  </div>
               </div>
                <div class="col-md-2 mb-3">
                  <label for="code">Grade </label>
                  <input type="text" name="mark_grade" id="mark_grade" class="form-control"  placeholder="e.g. F" @if(!empty($grade['grade'])) value="{{$grade['grade']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Mark Grade
                  </div>
               </div>
               
                <div class="col-md-2 mb-3">
                  <label for="code">Remarks </label>
                  <input type="text" name="remarks" id="remarks" class="form-control"  placeholder="e.g. Failed or Good" @if(!empty($grade['remarks'])) value="{{$grade['remarks']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Remarks
                  </div>
               </div>
                
               <div class="col-md-3 mb-3">     &nbsp;                        
                  <button class="mt-2 btn btn-primary btn-lg w-100  subject-grade-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Grade  </strong></button>
               </div>
            </div>
            </form>
         </div>
         <!-- ./ card-body -->    
        <p class=" mb-1 text-uppercase mt-4 title font-weight-700 text-lg text-center">{{$page_info['title']}} </p>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered dataTable">
                    <thead>  <tr>
                        <th>S/N </th>
                        <th>Mark From </th>
                        <th>Mark To </th>
                        <th>Grade </th>
                        <th>Remarks </th>
                        <th>Actions </th>
                        </tr></thead> <tbody>
                    @foreach($all_grades as $n=>$egrade)
                    <tr  @if(!empty($grade['id']) && $grade['id'] == $egrade['id']) class=" table-warning "  @endif >
                        <td>{{$n+1}} </td>
                         <td>{{$egrade['mark_from'] }} </td>
                         <td>{{$egrade['mark_to'] }} </td>
                         <td>{{$egrade['grade'] }} </td>
                         <td>{{$egrade['remarks'] }} </td>
                         <td> <a class="" grade_id="{{ $egrade['id']}}" href="{{url('admin/subject-grade-settings/'.$egrade['id']) }}">
                            <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>
                            
                            &nbsp; &nbsp; 
                           <a class="confirmDelete" title="{{ $egrade['remarks']}}" module="subject-grade" moduleid="{{ $egrade['id']}}" href="javascrpt:void(0)">
                          <i class="pe-7s-trash pe-2x text-danger" ></i></a>
                         </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
           
      </div>
   </div>
</div>
@endsection
