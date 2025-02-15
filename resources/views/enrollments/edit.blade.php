@extends('layouts.app')
@section('content')
    <div class="container1">
        <h1 class="h1">Edit Enrollment</h1>
        <form action="{{ route('enrollments.update', $enrollment) }}" method="POST">
            @csrf
            @method('PATCH')
            <!-- Select Student -->
            <div class="mb-3">
                <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" id="student_id" class="form-control1">
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                @error('student_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <!-- Select Subject -->
            <div class="mb-3">
                <label for="subject_id" class="form-label">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control1">
                            @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $enrollment->subject_id == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                 @error('subject_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Semester -->
            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                    <select name="semester" id="semester" class="form-control1">
                        <option value="1st" {{ $enrollment->semester == '1st' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2nd" {{ $enrollment->semester == '2nd' ? 'selected' : '' }}>2nd Semester</option>
                    </select>
                @error('semester') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <!-- School Year -->
            <div class="mb-3">
                    <label for="school_year" class="form-label">School Year</label>
                    <input type="text" name="school_year" id="school_year" class="form-control1" value="{{ old('school_year') }}" placeholder="2022-2023" required>
                @error('school_year') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
   
            <!-- Submit Button -->
            <div class="button-group">
                <x-primary-button type="submit">Add Enrollment</x-primary-button>
                <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection