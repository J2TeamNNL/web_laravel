<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::resource('courses', CourseController::class)->except([
    'show',
]);
// Route::group(['prefix' => 'courses', 'as' => 'course.'], function () {
//     Route::get('/', [CourseController::class, 'index'])->name('index');
//     Route::get('/create', [CourseController::class, 'create'])->name('create');
//     Route::post('/create', [CourseController::class, 'store'])->name('store');
//     Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('destroy');
//     Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
//     Route::put('/edit/{course}', [CourseController::class, 'update'])->name('update');
// });
