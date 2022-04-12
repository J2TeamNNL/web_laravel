<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::resource('courses', CourseController::class)->except([
    'show',
]);
Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');
Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('courses.api.name');

Route::resource('students', StudentController::class)->except([
    'show',
]);
Route::get('students/api', [StudentController::class, 'api'])->name('students.api');
