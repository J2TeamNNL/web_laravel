<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::resource('courses', CourseController::class)->except([
    'show',
]);
Route::get('test', function(){
    return view('layout.master');
});
