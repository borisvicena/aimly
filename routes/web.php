<?php

use App\Http\Controllers\AimlyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\TaskController;

// Aimly routes
Route::get('/', [AimlyController::class, 'index'])->name('index');

// Goal routes
Route::prefix('goal')->name('goal.')->group(function () {
    Route::get('/create', [GoalController::class, 'create'])->name('create');
    Route::post('/store', [GoalController::class, 'store'])->name('store');
    Route::get('/{id}', [GoalController::class, 'show'])->name('show');
    Route::post('/{id}/update', [GoalController::class, 'updateStatus'])->name('update');
    Route::delete('/{id}/delete', [GoalController::class, 'destroy'])->name('destroy');

    // Task routes nested under a goal
    Route::prefix('{goal}/task')->name('task.')->group(function () {
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/store', [TaskController::class, 'store'])->name('store');
    });
});

// Task routes (not nested)
Route::post('/task/{id}/update', [TaskController::class, 'toggleStatus'])->name('task.update');
Route::delete('/task/{id}/delete', [TaskController::class, 'destroy'])->name('task.destroy');