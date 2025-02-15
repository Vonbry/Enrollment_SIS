<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Providers\AppServiceProvider;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentDashboardController;


Route::get('/', function () {
    return view('welcome'); // Show welcome page instead of redirecting
});

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->name('dashboard');

// Admin Dashboard (Only accessible to Admins)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', function () {
        return view('admin.index');
    })->name('admin-dashboard');

    Route::resource('students', StudentController::class); // Adds CRUD routes for students
    Route::resource('subjects', SubjectController::class); // Adds CRUD routes for subjects
    Route::resource('enrollments', EnrollmentController::class); // Adds CRUD routes for enrollments
    Route::resource('grades', GradeController::class); // Adds CRUD routes for grades
});



// Student Dashboard (Only accessible to Students)
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])->name('student-dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
