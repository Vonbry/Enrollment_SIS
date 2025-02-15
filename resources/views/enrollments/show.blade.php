@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card student-card">
            <div class="card-body">
                <p class="p1"><strong>Student:</strong> {{ $enrollment->student->name }}</p>
                <p class="p1"><strong>Subject:</strong> {{ $enrollment->subject->name }}</p>
                <p class="p1"><strong>Semester:</strong> {{ $enrollment->semester }}</p>
                <p class="p1"><strong>School Year:</strong> {{ $enrollment->school_year }}</p>
                <div class="text-center mt-4">
                    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-lg">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
