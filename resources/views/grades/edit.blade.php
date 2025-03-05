@extends('layouts.app')

@section('content')
<div class="container1">
    <h1 class="h1">Edit Grades</h1>

    <form action="{{ route('grades.update', $grade) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label class="form-label">Student</label>
            <p class="form-control1">{{ $grade->student->name }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <p class="form-control1">{{ $grade->subject->name }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Midterm Grade</label>
            <input type="number" name="midterm" class="form-control1" step="0.01" min="1.00" max="5.00" value="{{ $grade->midterm }}" required>
            @error('midterm') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Final Grade</label>
            <input type="number" name="final" class="form-control1" step="0.01" min="1.00" max="5.00" value="{{ $grade->final }}" required>
            @error('final') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control1" required>{{ $grade->description }}</textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Grade</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
