<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckSuperAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');
Route::group([
    'middleware' => CheckLoginMiddleware::class,
], function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('courses', CourseController::class)->except([
        'show',
        'destroy',
    ]);
    Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');
    Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('courses.api.name');

    Route::resource('students', StudentController::class)->except([
        'show',
        'destroy',
    ]);
    Route::get('students/api', [StudentController::class, 'api'])->name('students.api');
    Route::group([
        'middleware' => CheckSuperAdminMiddleware::class,
    ], function(){
        Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
        Route::delete('students/{course}', [StudentController::class, 'destroy'])->name('students.destroy');
    });
});

