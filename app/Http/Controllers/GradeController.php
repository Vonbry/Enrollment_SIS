<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with('student', 'subject')->get();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('grades.create', compact('students', 'subjects'));
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
        'midterm' => [
            'nullable',
            'numeric',
            'min:0', // Allow 0 as a valid midterm grade
            'max:5',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->semester === '1st' && ($value === null || $value === '')) {
                    $fail('The midterm grade is required for 1st semester.');
                }
            }
        ],
        'final' => [
            'nullable',
            'numeric',
            'min:0', // Allow 0 as a valid final grade
            'max:5',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->semester === '2nd' && ($value === null || $value === '')) {
                    $fail('The final grade is required for 2nd semester.');
                }
            }
        ],
    ]);

    // Check if the grade record already exists for the student and subject
    $grade = Grade::where([
        'student_id' => $validated['student_id'],
        'subject_id' => $validated['subject_id']
    ])->first();

    if (!$grade) {
        // Create a new grade entry
        $grade = new Grade();
        $grade->student_id = $validated['student_id'];
        $grade->subject_id = $validated['subject_id'];
        $grade->midterm = ($request->midterm === 'INC' || $request->midterm === 'D' || $request->midterm === 'FDA') 
            ? $request->midterm 
            : (float) $request->midterm;

        $grade->final = ($request->final === 'INC' || $request->final === 'D' || $request->final === 'FDA') 
            ? $request->final 
            : (float) $request->final;

    } else {
        // Update only the selected semester grade without resetting the other
        if ($validated['semester'] === '1st') {
            $grade->midterm = $validated['midterm'];
        } else {
            $grade->final = $validated['final'];
        }
    }

    $grade->save();

    // If both midterm and final are present, calculate the average and grade
    if ($grade->midterm !== null && $grade->final !== null) {
        $average = ($grade->midterm + $grade->final) / 2;
        [$numeric_grade, $us_grade] = $this->getGradeDescription($average);
    
        $grade->update([
            'average' => $average,
            'numeric_grade' => $numeric_grade,
            'us_grade' => $us_grade // Ensure this field is updated
        ]);
    }
    

    return redirect()->route('grades.index')->with('success', 'Grade recorded successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $validated = $request->validate([
            'midterm_grade' => 'nullable|numeric|min:0|max:100',
            'final_grade' => 'nullable|numeric|min:0|max:100',
        ]);
    
        $average = ($request->midterm_grade + $request->final_grade) / 2;
        [$numeric_grade,$us_grade] = $this->getGradeDescription($average);

        $grade->midterm = ($request->midterm_grade === 'INC' || $request->midterm_grade === 'D' || $request->midterm_grade === 'FDA') 
        ? $request->midterm_grade 
        : (float) $request->midterm_grade;
        
        $grade->final = ($request->final_grade === 'INC' || $request->final_grade === 'D' || $request->final_grade === 'FDA') 
            ? $request->final_grade 
            : (float) $request->final_grade;
        
        $grade->save();
    
        return redirect()->route('grades.index')->with('success', 'Grade updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully!');
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
    

}
