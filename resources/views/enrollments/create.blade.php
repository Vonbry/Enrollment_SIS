@extends('layouts.app')

@section('content')
    <div class="container1 mt-4">
        <h1 class="h1">Add Enrollment</h1>

        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Student</label>
                <select name="student_id" class="form-control form-control1">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Subject</label>
                <select name="subject_id" class="form-control form-control1">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Semester</label>
                <select name="semester" class="form-control form-control1" required>
                    <option value="" disabled selected>Select Semester</option>
                    <option value="1st" {{ old('semester') == '1st' ? 'selected' : '' }}>1st</option>
                    <option value="2nd" {{ old('semester') == '2nd' ? 'selected' : '' }}>2nd</option>
                </select>
                @error('semester') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="school_year" class="form-label">School Year</label>
                <input type="text" name="school_year" id="school_year" class="form-control form-control1" value="{{ old('school_year') }}" placeholder="2022-2023" required>
                @error('school_year') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="button-group">
                <x-primary-button type="submit">Add Enrollment</x-primary-button>
                <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
