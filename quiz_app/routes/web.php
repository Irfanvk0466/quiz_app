<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuizController;
use App\Http\Middleware\AuthMiddleware;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AuthController::class,'register']);
Route::post('/register',[AuthController::class,'studentRegister'])->name('studentRegister');
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class,'studentLogin'])->name('studentLogin');

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/categories', [CategoryController::class, 'listCategories'])->name('listCategories');
    Route::get('/quiz/{category}', [CategoryController::class, 'showQuestions'])->name('showQuestions');
    Route::post('/check-answer', [QuizController::class, 'checkAnswer']);
    Route::get('/result/{category}', [QuizController::class, 'showResult']);
    Route::post('/result', [QuizController::class, 'submitQuiz']);
});











