<?php

use App\Http\Controllers\ProfileController;
use App\http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Candidat\QuizController;
use App\Http\Controllers\Candidat\HistoricalController;


Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'logout'])->name('logout');


Route::prefix('admin')->group(function (){
   Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
});


Route::resource('questions', QuestionController::class);
Route::resource('questions.answers', AnswerController::class);

Route::get('/quiz', [QuizController::class,'show'])->name('quiz.show');

Route::post('/answer',[HistoricalController::class , 'store'])->name('answer.store');
Route::get('/result',[HistoricalController::class , 'result'])->name('quiz.result');

require __DIR__.'/auth.php';

