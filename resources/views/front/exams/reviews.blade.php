<?php 
     
    use Carbon\Carbon;

?>
@extends('front.arch_layouts.layout')
@section('content')

<x-admin.card>
    <h3>
        Score: {{ $scheduleid->score }} / {{ $scheduleid->max_score }}
        &nbsp; &nbsp; <a href="{{url('student/exams/result/pdf/'.$scheduleid->id)}}" class="text-success" target="_blank"><i class="fa fa-download"></i></a>
    </h3>
    <hr>
    
    @foreach($questions as $index => $question)
    <div class="mb-4 p-3 border rounded">

        <h5>
            Question {{ $index + 1 }}
        </h5>

        <p class="h5">{!! $question->value !!}</p>

        @foreach($question->options as $option)

            @php
                $selected = isset($answers[$question->id]) 
                            && $answers[$question->id] == $option->id;

                $isCorrect = $option->is_correct;
            @endphp

            <div class="d-flex align-items-center mb-2">

                {{-- Option text --}}
                <span class="me-2 h6">
                    {{ chr(65 + $loop->index) }}.
                    {{ $option->value }}
                </span>

                {{-- ICON LOGIC --}}
                @if($selected && $isCorrect)
                    {{-- ✔ Selected & Correct --}}
                   &nbsp;&nbsp; <span class="text-success fw-bold ms-2">
                       <i class="fa fa-check fa-2x m-0 p-0"></i>
                    </span>

                @elseif($selected && !$isCorrect)
                    {{-- ✖ Selected & Wrong --}}
                    &nbsp;&nbsp; <span class="text-danger fw-bold ms-2">
                      <i class="fa fa-times fa-2x m-0 p-0"></i>  
                    </span>

                @elseif(!$selected && $isCorrect)
                    {{-- ✔ Correct but not selected --}}
                   &nbsp;&nbsp;  <span class="text-secondary fw-bold ms-2">
                        ✔
                    </span>
                @endif

            </div>

        @endforeach


    </div>
    @endforeach

    
</x-admin.card>
 
@endsection 
