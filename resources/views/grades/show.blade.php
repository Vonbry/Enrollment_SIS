@extends('layouts.app')

@section('content')
<div class="container">
    <div class="grade-details">
        <div class="details-header">
            <h2>Grade Details</h2>
            <a href="{{ route('grades.index') }}" class="btn btn-back">Back to List</a>
        </div>

        <div class="details-content">
            <div class="info-group">
                <label>Student:</label>
                <p>{{ $grade->student->name }}</p>
            </div>
            <div class="info-group">
                <label>Subject:</label>
                <p>{{ $grade->subject->name }} ({{ $grade->subject->units }} units)</p>
            </div>
            <div class="info-group">
                <label>Midterm:</label>
                <p>{{ number_format($grade->midterm, 2) }}</p>
            </div>
            <div class="info-group">
                <label>Final:</label>
                <p>{{ number_format($grade->final, 2) }}</p>
            </div>
            <div class="info-group">
                <label>Average:</label>
                <p>{{ number_format($grade->average, 2) }}</p>
            </div>
            <div class="info-group">
                <label>Rating:</label>
                <p>{{ $grade->us_grade }}</p>
            </div>
            <div class="info-group">
                <label>Semester:</label>
                <p>{{ $grade->semester }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
