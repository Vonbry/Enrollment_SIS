@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="enrollment-details">
            <div class="details-header">
                <h2>Enrollment Details</h2>
                <a href="{{ route('enrollments.index') }}" class="btn btn-back">Back to List</a>
            </div>

            <div class="details-content">
                <div class="info-group">
                    <label>Student:</label>
                    <p>{{ $enrollment->student->name }}</p>
                </div>
                <div class="info-group">
                    <label>Subject:</label>
                    <p>{{ $enrollment->subject->name }}</p>
                </div>
                <div class="info-group">
                    <label>Semester:</label>
                    <p>{{ $enrollment->semester }}</p>
                </div>
                <div class="info-group">
                    <label>School Year:</label>
                    <p>{{ $enrollment->school_year }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
