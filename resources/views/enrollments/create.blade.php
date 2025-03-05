@extends('layouts.app')

@section('content')
    <div class="container1 mt-4">
        <h1 class="h1">Add Enrollment</h1>

        <form id="enrollmentForm" action="{{ route('enrollments.store') }}" method="POST">
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
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('enrollmentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("enrollments.index") }}';
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message,
                    icon: 'error',
                    confirmButtonColor: '#3085d6'
                });
            }
        });
    });
    </script>
@endsection
