@extends('layout.common-layout')

@section('space-work')
<div class="result-container">
    <h1>Questions & Correct answers</h1>

    <div class="questions-container">
        @foreach($answers as $index => $answer)
            <div class="qa-row">
                <div class="question-box">
                    <p class="question-text">{{ $answer['question'] }}</p>
                </div>
                <div class="answer-box">
                    <p class="answer-text">{{ $answer['correctAnswer'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="winner">
        <p>{{ $resultMessage }}</p>
        <p>Your score: {{ $percentage }}%</p>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/result.css') }}">
@endsection
