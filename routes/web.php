<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, ProfileController, QuestionController, Question};

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    } else {
        return view('register');
    }

});

Route::get('/dashboard',DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/question.like/{question}', Question\LikeController::class )->name('question.like');

Route::middleware('auth')->group(function () {
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
