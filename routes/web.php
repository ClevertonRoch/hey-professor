<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Question;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    } else {
        return view('register');
    }

});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
    Route::post('/question.like/{question}', Question\LikeController::class)->name('question.like');
    Route::post('/question.unlike/{question}', Question\UnlikeController::class)->name('question.unlike');
    Route::put('/question.publish/{question}', Question\PublishController::class)->name('question.publish');
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::delete('/question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::put('/question/{question}', [QuestionController::class, 'update'])->name('question.update');
    Route::get('/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
