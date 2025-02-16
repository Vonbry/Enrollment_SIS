<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
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

    // Create a new student record using the user's details
    Student::create([
        'name' => $user->name,
        'email' => $user->email,
        'phone' => $user->phone,
        'address' => $user->address,
        'age' => $user->age,
        'year_level' => $request->year_level,
        'course' => $request->course,
    ]);

    // Update the user's status in the users table
    $user->update(['status' => 'added_as_student']);

    return redirect()->route('students.index')->with('success', 'Student added successfully.');
}


    public function show(Student $student)
    {
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
            'course' => 'required|string|in:BSIT,BSCS,BSCE,BSEd,BSBA',
        ]);

        // Update the student record
        $student->update($validated);

        // Also update the corresponding user record
        $user = \App\Models\User::where('email', $student->email)->first();
        if ($user) {
            $user->update([
                'name' => $validated['name'],
                'year_level' => $validated['year_level'],
                'course' => $validated['course'],
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }


    public function destroy(Student $student)
    {
        // Find the corresponding user based on email
        $user = \App\Models\User::where('email', $student->email)->first();
    
        if ($user) {
            // Update the user's status to "not_added_as_student"
            $user->update(['status' => 'not_added_as_student']);
        }
    
        // Delete the student record
        $student->delete();
    
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
    
}
