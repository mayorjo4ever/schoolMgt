<?php use App\Models\Subject;?><!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 13px;
        }
        .question {
            margin-bottom: 15px;
        }
        .correct {
            color: green;
            font-weight: bold;
        }
        .wrong {
            color: red;
            font-weight: bold;
        }
        .missed {
            color: #6c757d;
            font-weight: bold;
        }
        .capitalize{
            text-transform:capitalize; 
        }
    </style>
</head>
<body>

<h2>Mayorjo CBT Cafe</h2>
<p><strong>Student:{{ users_name_regno($userSchedule->user_id)}} </strong> </p>
<p class="capitalize"><strong>Subject:</strong> {{Subject::subjectName($userSchedule->schedule->subject_id) }} -  {{ $userSchedule->schedule->paper_type}}
 &nbsp; 
| &nbsp; Time :  {{ $userSchedule->started_at}}  To  {{ $userSchedule->ends_at}}
</p>
<p><strong>Score:</strong> {{ $userSchedule->score }} / {{ $userSchedule->max_score }}</p>

<hr>

@foreach($questions as $qIndex => $question)

    <div class="question">
        <strong>
            Q{{ $qIndex + 1 }}. {{ $question->value }}
        </strong>

        <br><br>

        @foreach($question->options as $option)

            @php
                $selected = isset($answers[$question->id]) 
                            && $answers[$question->id] == $option->id;

                $isCorrect = $option->is_correct;
            @endphp

            <div>
                {{ chr(65 + $loop->index) }}. {{ $option->value }}

                @if($selected && $isCorrect)
                <span class="correct" style="font-size:24px;">✔</span>

                @elseif($selected && !$isCorrect)
                    <span class="wrong" style="font-size:24px;">✖</span>

                @elseif(!$selected && $isCorrect)
                    <span class="missed" style="font-size:16px;">✔</span>
                @endif
            </div>

        @endforeach

    </div>

@endforeach
<hr>
<p><small>Copyright &copy; : Mayorjo CBT Exam  - Whatsapp : 07030577951 </small> </p>
</body>
</html>
