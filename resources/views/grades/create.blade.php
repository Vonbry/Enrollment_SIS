@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Add Grade</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('grades.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="student_id">Student</label>
                    <select name="student_id" class="form-control" required>
                        <option value="">Select Student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject_id">Subject</label>
                    <select name="subject_id" class="form-control" required>
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="midterm">Midterm Grade</label>
                    <input type="number" name="midterm" class="form-control" step="0.01" min="1.00" max="5.00" required>
                </div>

                <div class="form-group">
                    <label for="final">Final Grade</label>
                    <input type="number" name="final" class="form-control" step="0.01" min="1.00" max="5.00" required>
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" class="form-control" required>
                        <option value="">Select Semester</option>
                        <option value="1st">First Semester</option>
                        <option value="2nd">Second Semester</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Grade</button>
                    <a href="{{ route('grades.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
