<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('welcome.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::resource('/roles', RoleController::class)->except('show');
    Route::resource('/permissions', PermissionController::class)->except('show');
    Route::resource('/classrooms', ClassroomController::class)->except('show');
    Route::resource('/subjects', SubjectController::class)->except('show');
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students/{user}', [StudentController::class, 'assignClass'])->name('students.update');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/users/{user}/subjects/{subject}', [TeacherController::class, 'toggleAssignment'])->name('subject.toggle');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
