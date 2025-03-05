@extends('layouts.app')

@section('content')
<div class="container">
    <div class="edit-form-container">
        <div class="form-header">
            <h2>Add Student</h2>
            <a href="{{ route('students.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <form method="POST" action="{{ route('students.store') }}" class="edit-form">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="email">Email</label>
                    <select name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                        <option value="">Select Student Account</option>
                        @foreach($pendingStudents as $student)
                            <option value="{{ $student->email }}">
                                {{ $student->name }} - {{ $student->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="year_level">Year Level</label>
                    <select name="year_level" id="year_level" class="form-control @error('year_level') is-invalid @enderror" required>
                        <option value="">Select Year Level</option>
                        @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    @error('year_level')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="course">Course</label>
                    <select name="course" id="course" class="form-control @error('course') is-invalid @enderror" required>
                        <option value="">Select Course</option>
                        <option value="IT">IT</option>
                        <option value="NURSING">NURSING</option>
                        <option value="EDUC">EDUC</option>
                        <option value="BUSINESS AD">BUSINESS AD</option>
                        <option value="ACCOUNTING">ACCOUNTING</option>
                    </select>
                    @error('course')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Student
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>

        @if($pendingStudents->isEmpty())
            <div class="alert alert-info mt-4">
                <i class="fas fa-info-circle"></i> No pending student accounts available.
            </div>
        @endif
    </div>

    <!-- Student Role Account List -->
    <div class="list-container mt-4">
        <h3>Lists of Student Role Account</h3>
        <div class="table-responsive">
            <table class="management-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Year Level</th>
                        <th>Course</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingStudents as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->year_level }}</td>
                            <td>{{ $student->course }}</td>
                            <td>
                                <span class="status-badge {{ $student->status === 'added_as_student' ? 'status-active' : 'status-pending' }}">
                                    {{ str_replace('_', ' ', ucfirst($student->status)) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
