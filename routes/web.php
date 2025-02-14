<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Providers\AppServiceProvider;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome'); // Show welcome page instead of redirecting
});


// Admin Dashboard (Only accessible to Admins)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::resource('students', StudentController::class); // Adds CRUD routes for students
});



// Student Dashboard (Only accessible to Students)
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student-dashboard', function () {
        return view('students.dashboard');
    })->name('student-dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
