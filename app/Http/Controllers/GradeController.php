<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Enrollment;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])->get();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $students = Student::all();
    $enrolledSubjects = Enrollment::with(['subject', 'student'])->get();
    
    return view('grades.create', compact('students', 'enrolledSubjects'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'subject_id' => 'required|exists:subjects,id',
        'midterm' => 'required|numeric|between:1.00,5.00',
        'final' => 'required|numeric|between:1.00,5.00',
        'semester' => 'required|in:1st,2nd'
    ]);

    // Check if student is enrolled in this subject
    $enrollment = Enrollment::where('student_id', $validated['student_id'])
        ->where('subject_id', $validated['subject_id'])
        ->first();

    if (!$enrollment) {
        return response()->json([
            'status' => 'error',
            'message' => 'Student is not enrolled in this subject.'
        ]);
    }

    // Calculate average
    $average = ($validated['midterm'] + $validated['final']) / 2;
    
    // Create grade data
    $gradeData = [
        'student_id' => $validated['student_id'],
        'subject_id' => $validated['subject_id'],
        'midterm' => $validated['midterm'],
        'final' => $validated['final'],
        'semester' => $validated['semester'],
        'average' => number_format($average, 2),
        'numeric_grade' => number_format($average, 2),
        'us_grade' => $average <= 3.0 ? 'Passed' : 'Failed',
        'description' => 'Regular Grade'
    ];

    Grade::create($gradeData);

    return response()->json([
        'status' => 'success',
        'message' => 'Grade added successfully.'
    ]);
}

    private function calculateGradeRemarks($average)
    {
        return $average <= 3.00 ? 'Passed' : 'Failed';
    }
    
    private function calculateSemesterTotal($student_id, $semester)
    {
        $grades = Grade::where('student_id', $student_id)
            ->where('semester', $semester)
            ->whereNotNull('average')
            ->pluck('average');
    
        return $grades->count() > 0 ? $grades->sum() / $grades->count() : null;
    }
    
    private function normalizeGrade($grade)
    {
        if ($grade <= 1.00) return 1.00;
        if ($grade <= 1.25) return 1.25;
        if ($grade <= 1.50) return 1.50;
        if ($grade <= 1.75) return 1.75;
        if ($grade <= 2.00) return 2.00;
        if ($grade <= 2.25) return 2.25;
        if ($grade <= 2.50) return 2.50;
        if ($grade <= 2.75) return 2.75;
        if ($grade <= 3.00) return 3.00;
        if ($grade <= 4.00) return 4.00;
        return 5.00;
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        return view('grades.show', compact('grade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        $validator = \Validator::make($request->all(), [
            'midterm' => 'required|numeric|min:1|max:5',
            'final' => 'required|numeric|min:1|max:5',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $average = ($request->midterm + $request->final) / 2;
            $normalizedAverage = $this->normalizeGrade($average);

            $grade->midterm = $request->midterm;
            $grade->final = $request->final;
            $grade->description = $request->description;
            $grade->average = $normalizedAverage;
            $grade->numeric_grade = $normalizedAverage;
            $grade->us_grade = $this->calculateGradeRemarks($normalizedAverage);
            $grade->save();

            return redirect()->route('grades.index')
                ->with('success', 'Grade updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update grade.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')
            ->with('success', 'Grade deleted successfully');
    }

    private function getGradeDescription($numeric_grade)
    {
        if ($numeric_grade >= 1.00 && $numeric_grade <= 1.24) {
            return [1.00, "Passed"];
        } elseif ($numeric_grade >= 1.25 && $numeric_grade <= 1.49) {
            return [1.25, "Passed"];
        } elseif ($numeric_grade >= 1.50 && $numeric_grade <= 1.74) {
            return [1.50, "Passed"];
        } elseif ($numeric_grade >= 1.75 && $numeric_grade <= 1.99) {
            return [1.75, "Passed"];
        } elseif ($numeric_grade >= 2.00 && $numeric_grade <= 2.24) {
            return [2.00, "Passed"];
        } elseif ($numeric_grade >= 2.25 && $numeric_grade <= 2.49) {
            return [2.25, "Passed",];
        } elseif ($numeric_grade >= 2.50 && $numeric_grade <= 2.74) {
            return [2.50, "Passed"];
        } elseif ($numeric_grade >= 2.75 && $numeric_grade <= 2.99) {
            return [2.75, "Passed"];
        } elseif ($numeric_grade == 3.00) {
            return [3.00, "Pass"];
        } elseif ($numeric_grade > 3.00 && $numeric_grade <= 4.00) {
            return [4.00, "Conditional"];
        } else {
            return [5.00, "Failed"];
        }
    }
    
    private function updateSemesterTotal($student_id, $semester)
    {
        $grades = Grade::where('student_id', $student_id)
            ->where('semester', $semester)
            ->whereNotNull('average')
            ->pluck('average');
    
        if ($grades->count() > 0) {
            $semester_average = $grades->sum() / $grades->count();
        } else {
            $semester_average = null; // No grades available
        }
    
        if ($semester === '1st') {
            Grade::where('student_id', $student_id)
                ->update([
                    '1st_sem_total_grade' => $semester_average,
                    '2nd_sem_total_grade' => null  // Ensure 2nd semester is null
                ]);
        } else {
            Grade::where('student_id', $student_id)
                ->update([
                    '2nd_sem_total_grade' => $semester_average,
                    '1st_sem_total_grade' => null  // Ensure 1st semester is null
                ]);
        }
    }

    // Add this new method to get enrolled subjects
    public function getEnrolledSubjects($studentId)
    {
        try {
            $enrolledSubjects = Enrollment::where('student_id', $studentId)
                ->join('subjects', 'enrollments.subject_id', '=', 'subjects.id')
                ->select('subjects.id', 'subjects.code', 'subjects.name', 'enrollments.semester')
                ->get();
    
            \Log::info('Enrolled subjects:', ['student_id' => $studentId, 'subjects' => $enrolledSubjects->toArray()]);
    
            return response()->json($enrolledSubjects);
        } catch (\Exception $e) {
            \Log::error('Error fetching enrolled subjects: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch subjects'], 500);
        }
    }
    
}
