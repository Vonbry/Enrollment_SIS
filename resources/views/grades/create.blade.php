@extends('layouts.app')

@section('content')
<div class="container1 mt-4">
    <h1 class="h1">Add Grade</h1>

    <form id="gradeForm">
        @csrf
        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-control1" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control1" required>
                <option value="">Select Subject</option>
                @foreach($enrolledSubjects as $enrollment)
                    <option value="{{ $enrollment->subject->id }}" 
                            data-student="{{ $enrollment->student_id }}" 
                            style="display: none;" 
                            class="subject-option student-{{ $enrollment->student_id }}">
                        {{ $enrollment->subject->code }} - {{ $enrollment->subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Midterm Grade</label>
            <input type="number" name="midterm" class="form-control1" step="0.01" min="1.00" max="5.00" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Final Grade</label>
            <input type="number" name="final" class="form-control1" step="0.01" min="1.00" max="5.00" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Semester</label>
            <select name="semester" class="form-control1" required>
                <option value="">Select Semester</option>
                <option value="1st">1st Semester</option>
                <option value="2nd">2nd Semester</option>
            </select>
        </div>

        <button type="button" id="submitGrade" class="btn btn-primary">Save Grade</button>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const studentSelect = document.getElementById('student_id');
    const subjectSelect = document.getElementById('subject_id');
    const form = document.getElementById('gradeForm');
    const submitBtn = document.getElementById('submitGrade');

    studentSelect.addEventListener('change', function() {
        const studentId = this.value;
        const options = subjectSelect.querySelectorAll('option');
        
        options.forEach(option => {
            if (option.value === '') {
                option.style.display = 'block';
            } else {
                option.style.display = option.dataset.student === studentId ? 'block' : 'none';
            }
        });
        
        subjectSelect.value = '';
    });

    submitBtn.addEventListener('click', function() {
        const formData = new FormData(form);
        const data = {
            student_id: parseInt(formData.get('student_id')),
            subject_id: parseInt(formData.get('subject_id')),
            midterm: parseFloat(formData.get('midterm')),
            final: parseFloat(formData.get('final')),
            semester: formData.get('semester'),
            average: (parseFloat(formData.get('midterm')) + parseFloat(formData.get('final'))) / 2
        };
        
        fetch('{{ route("grades.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                window.location.href = '{{ route("grades.index") }}';
            } else {
                alert(data.message || 'An error occurred');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving the grade.');
        });
    });
});
</script>
@endpush

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@endsection
