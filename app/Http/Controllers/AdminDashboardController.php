<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\Grade;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalSubjects = Subject::count();
        $totalEnrollments = Enrollment::count();
        $totalGrades = Grade::count();

        return view('admin.index', compact(
            'totalStudents',
            'totalSubjects',
            'totalEnrollments',
            'totalGrades'
        ));
    }
} 