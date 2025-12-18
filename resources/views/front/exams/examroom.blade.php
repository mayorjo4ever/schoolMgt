@extends('front.arch_layouts.examlayout')
@section('content')
    @include('admin.arch_widgets.alert_message')
    
    <x-admin.card>
        @php //$questions = Session::get('questions');  @endphp
        <input type="hidden" id="exam_id" name="exam_id" value="{{$userSchedule->id}}" />
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
                       class="option-input"
                       
                        @checked(
                        isset($answers[$question->id]) &&
                        $answers[$question->id] == $option->id
                        )
                       >

                <strong>{{ chr(65 + $oIndex) }}.</strong>
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
     <x-admin.card>
         <span class="font-weight-700">GO TO QUESTIONS </span>
            <div id="question-palette" class="mb-3">
                @foreach ($questions as $index => $question)
                    <button
                        type="button"
                        class="btn btn-md palette-btn
                            {{ isset($answers[$question->id]) ? 'btn-success' : 'btn-secondary' }}"
                                    data-index="{{ $index + 1 }}"
                                    data-question-id="{{ $question->id }}"
                                >
                                {{ $index + 1 }}
                    </button>
                @endforeach
            </div>
        </x-admin.card>
@endsection 