<?php

use App\Http\Controllers\ProfileController;
use App\http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Candidat\QuizController;
use App\Http\Controllers\Candidat\HistoricalController;
use App\Http\Controllers\Staff\EventController;
use App\Http\Controllers\StaffPresentialTestController;


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

Route::get('/quiz', [QuizController::class,'show'])->name('quiz');
Route::get('/candidat/result',[HistoricalController::class , 'show'])->name('candidat.result');
Route::post('/answer',[HistoricalController::class , 'store'])->name('answer.store');
Route::get('/result',[HistoricalController::class , 'result'])->name('quiz.result');


// Route::get('/staff', function(){
//     return view('staff.index');
// })->name('satff');

Route::post('/store' ,[EventController::class , 'store'])->name('event.store');
route::get('/admin/result',[HistoricalController::class , 'calcul'])->name('results');
require __DIR__.'/auth.php';

Route::get('/staff',[EventController::class ,'index'])->name('satff');

Route::get('staff.assing',[StaffPresentialTestController::class, 'assignTechnicalTest'])->name('assing.staff');


