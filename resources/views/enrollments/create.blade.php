@extends('layouts.app')

@section('content')
    <div class="container1 mt-4">
        <h1 class="h1">Enrollments</h1>
        
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#enrollmentModal">
            <i class="fas fa-plus"></i> Add Enrollment
        </button>

        <!-- Enrollment Modal -->
        <div class="modal fade" id="enrollmentModal" tabindex="-1" aria-labelledby="enrollmentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="enrollmentModalLabel">Add New Enrollment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="enrollmentForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Student</label>
                                <select name="student_id" id="student_select" class="form-control">
                                    <option value="">Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}" data-course="{{ $student->course }}">
                                            {{ $student->name }} - {{ $student->course }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <select name="subject_id" id="subject_select" class="form-control" disabled>
                                    <option value="">Select Student First</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Semester</label>
                                <select name="semester" class="form-control" required>
                                    <option value="" disabled selected>Select Semester</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">School Year</label>
                                <input type="text" name="school_year" class="form-control" placeholder="YYYY-YYYY" required 
                                       pattern="\d{4}-\d{4}" title="Format: YYYY-YYYY">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitEnrollment">Save Enrollment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const studentSelect = document.getElementById('student_select');
        const subjectSelect = document.getElementById('subject_select');
        const submitBtn = document.getElementById('submitEnrollment');
        const form = document.getElementById('enrollmentForm');

        studentSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const course = selectedOption.getAttribute('data-course');
            
            if (course) {
                subjectSelect.disabled = false;
                fetch(`/api/subjects-by-course/${course}`)
                    .then(response => response.json())
                    .then(subjects => {
                        subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                        subjects.forEach(subject => {
                            const option = new Option(
                                `${subject.code} - ${subject.name} (${subject.units} units)`, 
                                subject.id
                            );
                            subjectSelect.add(option);
                        });
                    });
            } else {
                subjectSelect.disabled = true;
                subjectSelect.innerHTML = '<option value="">Select Student First</option>';
            }
        });

        submitBtn.addEventListener('click', function() {
            const formData = new FormData(form);
            fetch('{{ route("enrollments.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(Object.fromEntries(formData))
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            });
        });
    });
    </script>
    @endpush
@endsection
