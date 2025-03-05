<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Subject;


class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with('student', 'subject')->get();

        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('enrollments.create', compact('students', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'semester' => 'required|in:1st,2nd',
            'school_year' => ['required', 'regex:/^\d{4}-\d{4}$/'],
        ]);

        $student = Student::findOrFail($validated['student_id']);
        $subject = Subject::findOrFail($validated['subject_id']);

        // Check for existing enrollment
        $existingEnrollment = Enrollment::where('student_id', $student->id)
            ->where('subject_id', $subject->id)
            ->where('semester', $validated['semester'])
            ->where('school_year', $validated['school_year'])
            ->first();

        if ($existingEnrollment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student is already enrolled in this subject for the selected semester.'
            ]);
        }

        // Check for existing grades
        $existingGrade = \App\Models\Grade::where('student_id', $student->id)
            ->where('subject_id', $subject->id)
            ->where('semester', $validated['semester'])
            ->first();

        if ($existingGrade) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot enroll student. Student already has grades for this subject in the selected semester.'
            ]);
        }

        // Create Enrollment
        Enrollment::create($validated);

        // Verify the subject
        if ($subject->status !== 'verified') {
            $subject->update(['status' => 'verified']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Enrollment created successfully.'
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        return view('enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('enrollments.edit', compact('enrollment', 'students', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'semester' => 'required|in:1st,2nd',
            'school_year' => ['required', 'regex:/^\d{4}-\d{4}$/'], // Ensure format like 2022-2023
        ]);

        $enrollment->update($validated);
        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully');
    }
}
