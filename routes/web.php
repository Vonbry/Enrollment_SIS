<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Providers\AppServiceProvider;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('welcome');
});



// Admin Dashboard (Only accessible to Admins)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');

    Route::resource('students', StudentController::class); // Adds CRUD routes for students
    Route::resource('subjects', SubjectController::class); // Adds CRUD routes for subjects
    Route::resource('enrollments', EnrollmentController::class); // Adds CRUD routes for enrollments
    Route::resource('grades', GradeController::class); // Adds CRUD routes for grades
    Route::post('/students/approve/{user}', [StudentController::class, 'approve'])->name('students.approve');
    Route::delete('/students/decline/{user}', [StudentController::class, 'decline'])->name('students.decline');
    Route::get('/students/{student}/view', [StudentController::class, 'show'])->name('students.show');
    Route::get('/report/grades', [ReportController::class, 'grades'])->name('report.grades');
    Route::get('/api/students/{student}/enrolled-subjects', [GradeController::class, 'getEnrolledSubjects']);
   
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('grades', GradeController::class)->except(['index', 'show']);
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

Route::get('/api/subjects-by-course/{course}', [EnrollmentController::class, 'getSubjectsByCourse'])
     ->name('subjects.by.course');

Route::get('/api/students/{student}/enrolled-subjects', [GradeController::class, 'getEnrolledSubjects'])
     ->name('students.enrolled-subjects');

require __DIR__.'/auth.php';
