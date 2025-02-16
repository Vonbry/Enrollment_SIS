@extends('layouts.app')

@section('content')
    <div class="container1">
        <h1 class="h1">Edit Student</h1>
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Student ID -->
            <div class="mb-3">
                <label>Student ID</label>
                <input type="text" name="id" class="form-control1" value="{{ $student->id }}" readonly>
            </div>

            <!-- Name -->
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control1" value="{{ $student->name }}" required>
            </div>

            <!-- Email (Read-Only) -->
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control1" value="{{ $student->email }}" readonly>
            </div>

            <!-- Year Level Dropdown -->
            <div class="mb-3">
                <label>Year Level</label>
                <select name="year_level" class="form-control1" required>
                    <option value="" disabled>Select Year Level</option>
                    @for ($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}" {{ $student->year_level == $i ? 'selected' : '' }}>{{ $i }} Year</option>
                    @endfor
                </select>
            </div>

            <!-- Course Dropdown -->
            <div class="mb-3">
                <label>Course</label>
                <select name="course" class="form-control1" required>
                    <option value="" disabled>Select Course</option>
                    <option value="BSIT" {{ $student->course == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                    <option value="BSCS" {{ $student->course == 'BSCS' ? 'selected' : '' }}>BSCS</option>
                    <option value="BSCE" {{ $student->course == 'BSCE' ? 'selected' : '' }}>BSCE</option>
                    <option value="BSEd" {{ $student->course == 'BSEd' ? 'selected' : '' }}>BSEd</option>
                    <option value="BSBA" {{ $student->course == 'BSBA' ? 'selected' : '' }}>BSBA</option>
                </select>
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="button-group">
                <x-primary-button type="submit">Add Enrollment</x-primary-button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
