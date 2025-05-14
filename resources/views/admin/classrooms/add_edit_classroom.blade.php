@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
            
            @include('admin.arch_widgets.alert_message')
             
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">{{$page_info['title']}} </div>
            <div class="card-body">
                <form class="needs-validation" novalidate @if(!empty($classroom['id'])) action="{{url('admin/add-edit-classroom/'.$classroom['id'])}}" @else action="{{url('admin/add-edit-classroom')}} " @endif  method="post">@csrf
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="title">Class Room Name </label>
                            <input type="text" name="name" id="class-name" class="form-control"  placeholder="e.g : JSS 3 A" @if($classroom['id'] !="") value="{{$classroom['name']}}"  @endif required >
                            <div class="invalid-feedback">
                               Provide Class Room Name
                            </div>
                         </div>  <!-- ./ col-md-3 -->
                         
                         <div class="col-md-3 mb-3">
                             <label class="text-capitalize" style="font-weight: 600"> Class Level </label>
                            <select name="level" id="level" class="form-control" required="">
                               <option value=""> --- </option>
                               @foreach($levels as $level)
                               <option value="{{$level['id']}}"  @selected($classroom['level_id']==$level['id']) @endselected > {{$level['name']}} </option>
                               @endforeach
                            </select>
                            <div class="invalid-feedback">
                               Please Select  Level
                            </div>
                         </div>
                    <!-- ./ col-md-3 -->
                        
                         <div class="col-md-3 mb-3">
                            <label for="title">Student Capacity </label>
                            <input type="number" name="capacity" id="capacity" class="form-control"  placeholder="e.g : 30  "  @if(!empty($classroom['capacity'])) value="{{$classroom['capacity']}}" @endif required >
                            <div class="invalid-feedback">
                               Provide Student Capacity 
                            </div>
                         </div>  <!-- ./ col-md-3 -->
                         
                    </div> <!-- ./ form-row -->
                     <div class="form-row">
                         <div class="col-md-5 mb-3">     &nbsp;                        
                           <button class="mt-0 btn btn-primary btn-lg w-100  subject-btn ladda-button" data-style="expand-right" type="submit"> <strong> Save Class Room  </strong></button>
                         </div>
                    </div> <!-- ./ form-row -->
               </form>
            </div>  <!-- ./ card-body -->              
        </div>
    </div>
</div>

@endsection 