<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Travelx\School\App\Http\Controllers\SchoolController;
use Travelx\School\App\Http\Controllers\StudentController;
use Travelx\School\App\Http\Controllers\SubjectController;
use Travelx\School\App\Http\Controllers\TeacherController;

Route::get('/school', function () {
    $school = Str::of('Hi From Route');
    return view('school::Home',compact('school'));
})->name('home');


Route::get('/schoolController', [SchoolController::class,'index'])->name('home');
Route::resource('/students', StudentController::class)->names([
    'index' => 'students.index',
    'create' => 'students.create',
    'store' => 'students.store',
    'show' => 'students.show',
    'edit' => 'students.edit',
    'update' => 'students.update',
    'destroy' => 'students.destroy',
]);
Route::resource('/teachers', TeacherController::class);
Route::resource('/subjects', SubjectController::class);