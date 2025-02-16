<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the corresponding student record
        $student = Student::where('email', $user->email)->first();

        // Ensure the student exists before fetching grades
        if (!$student) {
            return redirect()->back()->with('error', 'Student record not found.');
        }

        // Fetch only the grades of the logged-in student
        $grades = Grade::where('student_id', $student->id)->with('subject')->get();

        return view('students.dashboard', compact('grades'));
    }
}
