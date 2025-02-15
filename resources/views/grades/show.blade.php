@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Grade Details</h2>

    <div class="mb-3">
        <label class="form-label">Student:</label>
        <p class="form-control">{{ $grade->student->name }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Subject:</label>
        <p class="form-control">{{ $grade->subject->name }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Midterm Grade:</label>
        <p class="form-control">{{ $grade->midterm_grade }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Final Grade:</label>
        <p class="form-control">{{ $grade->final_grade }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Average Grade:</label>
        <p class="form-control">{{ $grade->average_grade }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Grade Description:</label>
        <p class="form-control">{{ $grade->grade_description }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">US Grade:</label>
        <p class="form-control">{{ $grade->us_grade }}</p>
    </div>

    <a href="{{ route('grades.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
