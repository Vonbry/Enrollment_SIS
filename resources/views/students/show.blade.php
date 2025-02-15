@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card student-card">
            <div class="card-body">
                <h2 class="h2 text-center text-primary">Student Details</h2>
                <br>
                <p class="p1"><strong>Name:</strong> {{ $student->name }}</p>
                <p class="p1"><strong>Email:</strong> {{ $student->email }}</p>
                <p class="p1"><strong>Phone:</strong> {{ $student->phone }}</p>
                <p class="p1"><strong>Address:</strong> {{ $student->address }}</p>
                <p class="p1"><strong>Age:</strong> {{ $student->age }}</p>
                <div class="text-center mt-4">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary btn-lg">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
