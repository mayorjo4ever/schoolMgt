@extends('front.arch_layouts.examlayout')
@section('content')
    @include('admin.arch_widgets.alert_message')
    
    <x-admin.card>
        @php //$questions = Session::get('questions'); 
        // print "<pre>";  print_r($questions); print "</pre>";
        @endphp
       @foreach($questions as $qIndex => $question)
        <div class="question"
             data-index="{{ $qIndex + 1 }}"
             data-qid="{{ $question->id }}"
             style="display:none">

            <h4 class="mb-3">
                {{ $qIndex + 1 }}. &nbsp; &nbsp;  {{ $question->value }}
            </h4>

    <div class="options">
        @foreach($question->options as $oIndex => $option)
            <label class="d-block mb-3 font-size-lg">
                <input type="radio"
                       name="answer[{{ $question->id }}]"
                       value="{{ $option->id }}"
                       class="option-input">

                        {{ chr(65 + $oIndex) }}.
                        {{ $option->value }}
                    </label>
                @endforeach
            </div>

        </div>
        @endforeach

        
        <div class="mt-5 pt-5 text-center">
            <button id="prevBtn" class="btn btn-light btn-lg p-3" style="width:100px; ">Previous</button>
            <span id="counter" class="mx-3"></span>
            <button id="nextBtn" class="btn btn-primary btn-lg p-3" style="width:100px; ">Next</button>
        </div>
    </x-admin.card>
@endsection 