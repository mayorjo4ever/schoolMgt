@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
   <div class="col-md-12">
       @include('admin.arch_widgets.alert_message')
      <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
         <div class="card-header"> {{$page_info['title']}} </div>
         <div class="card-body">
            <form id="testExamMarksForm" @if(!empty($settings['id'])) action="{{url('admin/test_exam_marks_settings/'.$settings['id'])}}" @else action="{{url('admin/test_exam_marks_settings')}} " @endif  method="post">@csrf
            <div class="form-row">
               <div class="col-md-2 mb-3">
                  <label for="title">1st C.A Max. Score </label>
                  <input type="text" name="ca_1" id="ca_1" class="form-control"  placeholder="e.g 20"  @if(!empty($settings['ca_1'])) value="{{$settings['ca_1']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide 1st C.A Max Score
                  </div>
               </div>
               <div class="col-md-2 mb-3">
                  <label for="code"> 2nd C.A Max. Score </label>
                  <input type="text" name="ca_2" id="ca_2" class="form-control"  placeholder="e.g. 20" @if(!empty($settings['ca_2'])) value="{{$settings['ca_2']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide 2nd C.A Max Score
                  </div>
               </div>
                <div class="col-md-2 mb-3">
                  <label for="code">Exam Max. Score </label>
                  <input type="text" name="exam" id="exam" class="form-control"  placeholder="e.g. 60" @if(!empty($settings['exam'])) value="{{$settings['exam']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Exam Max. Score
                  </div>
               </div>
               
               <!-- <div class="col-md-2 mb-3">
                  <label for="code"> Applicable To and Session  </label>
                  <input type="text" name="remarks" id="remarks" class="form-control"  placeholder="e.g. Failed or Good" @if(!empty($settings['remarks'])) value="{{$settings['remarks']}}" @endif required >
                  <div class="invalid-feedback">
                     Provide Remarks
                  </div>
               </div> -->
                
               <div class="col-md-3 mb-3">     &nbsp;                        
                  <button class="mt-2 btn btn-primary btn-lg w-100  subject-grade-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Settings  </strong></button>
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
                        <th>1st C.A Max Score </th>
                        <th>2nd C.A Max Score </th>
                        <th>Exam Max Score </th> 
                        <th>Actions </th>
                        </tr></thead> <tbody>
                    @foreach($all_scores as $n=>$scores)
                    <tr>
                        <td>{{$n+1}} </td>
                         <td>{{$scores['ca_1'] }} </td>
                         <td>{{$scores['ca_2'] }} </td>
                         <td>{{$scores['exam'] }} </td>
                         
                         <td> <a class="" scores_id="{{ $scores['id']}}" href="{{url('admin/test_exam_marks_settings/'.$scores['id']) }}">
                            <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>
                            
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
