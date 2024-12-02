@extends('layout/common-layout')

@section('space-work')
<div class="quiz-box">
    <div class="quiz-container">
        <div class="header">
            <div class="timer">
                <div id="timer-square">
                    <span id="countdown">30</span>
                </div>
            </div>
            <div class="question-count">
                <span class="badge">
                    <span id="question-number">1</span> / <span id="total-questions">{{ count($questions) }}</span>
                </span>
            </div>
        </div>
        @foreach($questions as $index => $question)
            <div class="question" id="question-{{ $index }}" style="{{ $index !== 0 ? 'display: none;' : '' }}">
                <h3>{{ $question['question'] }}</h3>
                <div class="options">
                    @foreach(array_merge([$question['correctAnswer']], $question['incorrectAnswers']) as $answer)
                        <button onclick="checkAnswer(this)" class="option-button" data-question="{{ $question['question'] }}" data-answer="{{ $answer }}" data-question-id="{{ $question['id'] }}" data-category="{{ $question['category'] }}">
                            {{ $answer }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="footer">
            <button class="reset-button" onclick="resetQuiz()">Reset</button>
            <button class="next-button" onclick="nextQuestion()">Next</button>
            <button id="submit-button" class="btn-success" style="display: none;" onclick="submitQuiz()">Submit</button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/quiz.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/quiz.js') }}" defer></script>
@endsection
