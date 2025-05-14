<?php 
    use App\Models\Subject; 
?>
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
               <form id="subjectForm" action="{{url('admin/questions/view')}}" method="post">@csrf
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="title">Select Subject  </label>
                            <select name="subject" id="subject-title" class="form-control" required >
                                <option value="">Select Subject </option>
                                @foreach($subjects as $subject)
                                 <option value="{{$subject['id']}}" @if( Session::get('sid')==$subject['id']) selected @endif >{{$subject['code'] . " -> ". $subject['title'] }}</option>
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
                                <option value="test" @if( Session::get('qtype')=="test") selected @endif >Test </option>                                
                                 <option value="exam" @if( Session::get('qtype')=="exam") selected @endif >Exam </option>
                            </select>
                            <div class="invalid-feedback">
                               Provide Question TYpe 
                            </div>
                         </div>
                        
                         <div class="col-md-3 mb-3">     &nbsp;                        
                           <button class="mt-2 btn btn-primary btn-lg w-100  subject-btn ladda-button" data-style="expand-right" type="submit"> <strong> Show Question </strong></button>
                         </div>
                    </div>
               </form>
            </div>  <!-- ./ card-body -->              
        </div><!-- extension=gd 
        extension=zip -->
        
        <?php $i = 1; $label = range('A','H'); ?>
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">          
            <div class="card-header">
                    <div class="col-md-6 pull-left ">  
                    @if(Session::get('sid')!="")
                        {{ Subject::subjectName(Session::get('sid'))}}&nbsp;
                        {{ Session::get('qtype')}}
                     @else Select Subject 
                    @endif
                    </div>
                    <div class="col-md-6 pull-right "> 
                        <input id="closeTime" type="hidden" value="{{Session::get('submitTime')}}"/>
                        <div class="readingTime"></div>
                    </div>
                </div>
            <div class="card-body">
               
                 @if(!empty($questions))
                
                 <div class="table"> <form method="post" action="{{url('admin/questions/submit-answers')}}">@csrf 
                    <table class="table table-striped">                       
                        @foreach($questions as $question)
                        <tr>
                            <td class="">{{$i}}</td>
                            <td class="w-48 font-weight-bold">{{$question['value']}}</td>
                            <td  class="w-50">
                                <table class="table table-secondary"> <?php $j =0 ;?>
                                     @foreach($question['options'] as $option)
                                       <tr>                                         
                                           <td class="w-5">{{$label[$j]}}</td>
                                        <td> <label class=""><input type="radio" name="q-{{$question['id']}}" value="{{$option['id']}}" /> &nbsp; {{$option['value']}} </label></td>
                                       </tr>
                                       <?php $j++;?>
                                     @endforeach
                                     <?php $j = 0 ;?>
                                </table>
                            </td>
                        </tr>
                         <?php $i++; ?>
                        @endforeach        
                        <tfoot>
                            <tr>
                                <td align="center" colspan="3"> <button class="btn btn-primary  btn-shadow  btn-lg w-100">  Submit </button></td>
                            </tr>
                        </tfoot>
                    </table>
                   </form>
                </div> 
                  @endif
            </div>
        </div>
              
              
    </div>
</div>
<script> 
       
</script>
@endsection 