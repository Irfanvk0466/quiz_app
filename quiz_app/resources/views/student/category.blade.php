@extends('layout/common-layout')

@section('space-work')

<div class="quiz-container">
    <h1>Online Quiz</h1>
    <h2>Select Quiz Type</h2>
    <div class="quiz-buttons">
        @if($pagedCategories->count() > 0)
            @foreach($pagedCategories as $categoryName => $subcategories)
                <a href="{{ route('showQuestions', ['category' => $categoryName]) }}">
                    <button>{{ $categoryName }}</button>
                </a>
            @endforeach
        @else
            <p>No categories available at the moment. Please try again later.</p>
        @endif
    </div>
    <div class="pagination-dots">
        @for ($i = 1; $i <= $pagedCategories->lastPage(); $i++)
        <span class="{{ $i == $pagedCategories->currentPage() ? 'active' : '' }}">
            <a href="{{ $pagedCategories->url($i) }}"></a>
        </span>
        @endfor
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/category.css') }}">

@endsection
