@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
         @include('admin.arch_widgets.alert_message')
         
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">{{$page_info['title']}} </div>
            <div class="card-body">
                <form id="" class="needs-validation" novalidate  action="{{url('admin/academic-calendar')}}"  method="post">@csrf
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="title" class="font-weight-bold">Current Session </label>
                            <select name="cur_session" class="form-control" required="">
                                <option value=""  > ... </option>                                
                                @foreach($sessions as $sess)
                                <?php $sess = $sess."/".($sess+1);?>
                                <option value="{{$sess}}" @selected($calendar['current_session']==$sess)> {{$sess}} </option> 
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                               Provide Current Session
                            </div>
                         </div> 
                        
                        <div class="col-md-3 mb-3">
                            <label for="title"  class="font-weight-bold"> Term Begins </label>
                            <input type="text" name="term_begins" id="" class="form-control bg-white datepicker"  placeholder=" Term Begins "  @if(!empty($calendar['term_begins'])) value="{{$calendar['term_begins']}}" @else value="{{old('term_begins')}}"  @endif  required="" >
                            <div class="invalid-feedback">
                               Term Begins
                            </div>
                         </div> 
                        
						 <div class="col-md-3 mb-3">
                            <label for="title"  class="font-weight-bold"> Term Ends </label>
                            <input type="text" name="term_ends" id="" class="form-control bg-white datepicker"  placeholder=" Term Ends "  @if(!empty($calendar['term_ends'])) value="{{$calendar['term_ends']}}" @else value="{{old('term_ends')}}" @endif required >
                            <div class="invalid-feedback">
                               Provide Term Ends
                            </div>
                         </div>  
                        
                    </div> <!-- ./ form-row  -->
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="title"  class="font-weight-bold">Current Term  </label>
                            <select name="cur_term" class="form-control" required="">
                                <option value=""  > ... </option>                                
                               @foreach($terms as $term)
                                <option value="{{$term['id']}}" @if($calendar['current_term']==$term['id']) selected @endif @selected(old('cur_term')==$term['id']) > {{ $term['name']}} Term </option>   
                               @endforeach
                            </select>
                            <div class="invalid-feedback">
                               Provide Current Term
                            </div>
                         </div> 
                        
                        <div class="col-md-3 mb-3">
                            <label for="title"  class="font-weight-bold">Next Term Begins </label>
                            <input type="text" name="next_term" id="" class="bg-white form-control datepicker"  placeholder="Next Term Begins "  @if(!empty($calendar['next_term_begins'])) value="{{$calendar['next_term_begins']}}"  @else value="{{old('next_term')}}" @endif  required="" >
                            <div class="invalid-feedback">
                               Next Term Begins
                            </div>
                         </div>    
						 
                         <div class="col-md-3 mb-3">     &nbsp;                        
                           <button class="mt-2 btn btn-primary btn-lg w-100  calendar-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Calendar  </strong></button>
                         </div>
                    </div> <!-- ./ form-row  -->
               </form>
            </div>  <!-- ./ card-body -->   
            <div class="card-footer">
                <table class=" table   table-info text-dark mt-0 font-size-lg text-capitalize font-weight-normal"> 
                    <tr> <td> Created At : {{ \Carbon\Carbon::parse($calendar['created_at'])->diffForHumans()}} </td> 
                        <td> Last Update : {{ \Carbon\Carbon::parse($calendar['updated_at'])->diffForHumans()}}  </td> </tr> </table>
            </div>
        </div>
    </div>
</div>

@endsection 