<?php

use App\Http\Controllers\ProfileController;
use App\http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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




require __DIR__.'/auth.php';

