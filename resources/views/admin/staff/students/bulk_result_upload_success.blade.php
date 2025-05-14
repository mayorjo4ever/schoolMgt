<?php 
use App\Models\Term;
use App\Models\ClassRoom;
use App\Models\Subject;
?>
@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
            <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
                <div class="card-body">
                    
                    <div class="card-title border border-success p-3">
                        Academic Session : {{Session::get('acad_session')}} , &nbsp;
                        term : {{Term::name(Session::get('term'))}} Term , &nbsp;
                        Classroom  : {{Classroom::name(Session::get('class-room'))}} , &nbsp;
                        Subject  : {{Subject::name(Session::get('subject_id'))}} &nbsp;
                    </div>   
                @if(Session::get('success'))    
                    @foreach(Session::get('success') as $message)
                        <p class="mt-2 border-bottom border-light text-success text-uppercase text-lg  font-weight-bold"> {{$message}} </p>
                    @endforeach
                @endif 
                
                 @if(Session::get('errors'))  
                 @foreach(Session::get('errors') as $message) 
                    <p class="mt-2 border-bottom border-light text-danger  text-uppercase text-lg font-weight-bold"> 
                         {{ $message }} 
                    </p>
                @endforeach
                @endif 
                </div> <!-- card-body -->
                
                <a href="{{url('admin/upload-results')}}" class="btn btn-success btn-lg w-100"> Continue </a>
            </div> <!-- main card -->
        </div>
</div>

@endsection 

