<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $pendingStudents = \App\Models\User::where('role', 'student')
            ->where(function($query) {
                $query->where('status', 'not_added_as_student')
                      ->orWhereNull('status');
            })
            ->get();

        return view('students.index', compact('students', 'pendingStudents'));
    }

    public function create()
    {
        // Get students with 'student' role who haven't been added to students table yet
        $pendingStudents = \App\Models\User::where('role', 'student')
            ->where('status', 'not_added_as_student')
            ->get();

        return view('students.create', compact('pendingStudents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Find the user with student role and 'not_added_as_student' status
        $user = \App\Models\User::where('email', $validated['email'])
            ->where('role', 'student')
            ->where('status', 'not_added_as_student')
            ->first();

        if (!$user) {
            return redirect()->route('students.index')->with('error', 'Student not found or already added.');
        }

        // Generate student ID (format: YYYY-COURSE-XXXXX)
        $year = date('Y');
        $course = strtoupper($request->course);
        
        $lastStudent = Student::where('student_id', 'like', $year . '-' . str_replace(' ', '', $course) . '-%')
            ->orderBy('student_id', 'desc')
            ->first();

        if ($lastStudent) {
            $lastNumber = intval(substr($lastStudent->student_id, -5));
            $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '00001';
        }

        $studentId = $year . '-' . $course . '-' . $newNumber;

        // Create a new student record
        Student::create([
            'student_id' => $studentId,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'age' => $user->age,
            'year_level' => $request->year_level,
            'course' => $request->course,
        ]);

        // Update user status
        $user->update(['status' => 'added_as_student']);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $student->load('user', 'enrollments');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year_level' => 'required|integer|min:1|max:6',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
        ]);

        // Create update array without course
        $updateData = [
            'name' => $validated['name'],
            'year_level' => $validated['year_level'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'age' => $validated['age'],
        ];

        // Update the student record
        $student->update($updateData);

        // Also update the corresponding user record
        $user = \App\Models\User::where('email', $student->email)->first();
        if ($user) {
            $user->update($updateData);
        }

        // Redirect to students list with success message
        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        // Check if student has any grades
        if ($student->grades()->exists()) {
            return back()->with('error', 'Cannot delete student because they have existing grades.');
        }

        // Check if student has any enrollments
        if ($student->enrollments()->exists()) {
            return back()->with('error', 'Cannot delete student because they have active enrollments.');
        }

        // Find the corresponding user based on email
        $user = \App\Models\User::where('email', $student->email)->first();
        if ($user) {
            $user->update(['status' => 'not_added_as_student']);
        }

        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    public function approve(Request $request, $userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        
        // Create a new student record without student_id
        Student::create([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'age' => $user->age,
            'year_level' => $user->year_level,
            'course' => $user->course,
        ]);

        // Update user status
        $user->update(['status' => 'added_as_student']);

        return redirect()->route('students.index')->with('success', 'Student approved successfully.');
    }

    public function decline(Request $request, $userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $user->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student registration declined.');
    }
}
