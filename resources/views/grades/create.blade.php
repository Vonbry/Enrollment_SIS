@extends('layouts.app')

@section('content')
<div class="container1">
    <h1 class="h1">Add Grades</h1>

    <form action="{{ route('grades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-control1" required>
                <option value="">Select Student</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
            @error('student_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-control1" required>
                <option value="">Select Subject</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('subject_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Semester</label>
            <select name="semester" class="form-control1" required id="semester">
                <option value="">Select Semester</option>
                <option value="1st">1st Semester</option>
                <option value="2nd">2nd Semester</option>
            </select>
            @error('semester') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Midterm Grade</label>
            <select name="midterm" class="form-control1">
                <option value="">Select Grade</option>
                <option value="1.00">1.00 (A+)</option>
                <option value="1.25">1.25 (A)</option>
                <option value="1.50">1.50 (A-)</option>
                <option value="1.75">1.75 (B+)</option>
                <option value="2.00">2.00 (B)</option>
                <option value="2.25">2.25 (B-)</option>
                <option value="2.50">2.50 (C+)</option>
                <option value="2.75">2.75 (C)</option>
                <option value="3.00">3.00 (C-)</option>
                <option value="4.00">4.00 (D - Conditional)</option>
                <option value="5.00">5.00 (F - Failed)</option>
                <option value="INC">INC (Incomplete)</option>
                <option value="D">D (Drop)</option>
                <option value="FDA">FDA (Failure Due to Absence)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Final Grade</label>
            <select name="final" class="form-control1">
                <option value="">Select Grade</option>
                <option value="1.00">1.00 (A+)</option>
                <option value="1.25">1.25 (A)</option>
                <option value="1.50">1.50 (A-)</option>
                <option value="1.75">1.75 (B+)</option>
                <option value="2.00">2.00 (B)</option>
                <option value="2.25">2.25 (B-)</option>
                <option value="2.50">2.50 (C+)</option>
                <option value="2.75">2.75 (C)</option>
                <option value="3.00">3.00 (C-)</option>
                <option value="4.00">4.00 (D - Conditional)</option>
                <option value="5.00">5.00 (F - Failed)</option>
                <option value="INC">INC (Incomplete)</option>
                <option value="D">D (Drop)</option>
                <option value="FDA">FDA (Failure Due to Absence)</option>
            </select>
        </div>

        <div class="button-group">
            <x-primary-button type="submit">Add Subjects</x-primary-button>
            <a href="{{ route('grades.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>


@endsection
