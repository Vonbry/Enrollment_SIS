@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card subject-card">
            <div class="card-body">
                <h2 class="h2 text-center text-primary">Subject Details</h2>
                <br>
                <p class="p1"><strong>Subject Code:</strong> {{ $subject->code }}</p>
                <p class="p1"><strong>Subject Name:</strong> {{ $subject->name }}</p>
                <p class="p1"><strong>Units:</strong> {{ $subject->units }}</p>

                <div class="text-center mt-4">
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-lg">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
