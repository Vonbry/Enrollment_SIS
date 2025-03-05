@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="student-profile">
            <div class="profile-header">
                <h2>Student Profile</h2>
                <a href="{{ route('students.index') }}" class="btn btn-back">Back to List</a>
            </div>

            <div class="profile-content">
                <!-- Personal Information Section -->
                <div class="profile-section">
                    <h3>Personal Information</h3>
                    <div class="info-group">
                        <label>Student ID:</label>
                        <p>{{ $student->student_id ?? 'Not assigned' }}</p>
                    </div>
                    <div class="info-group">
                        <label>Name:</label>
                        <p>{{ $student->name }}</p>
                    </div>
                    <div class="info-group">
                        <label>Email:</label>
                        <p>{{ $student->email }}</p>
                    </div>
                    <div class="info-group">
                        <label>Phone:</label>
                        <p>{{ $student->phone }}</p>
                    </div>
                    <div class="info-group">
                        <label>Address:</label>
                        <p>{{ $student->address }}</p>
                    </div>
                    <div class="info-group">
                        <label>Age:</label>
                        <p>{{ $student->age }}</p>
                    </div>
                </div>

                <!-- Academic Information Section -->
                <div class="profile-section">
                    <h3>Academic Information</h3>
                    <div class="info-group">
                        <label>Course:</label>
                        <p>{{ $student->course }}</p>
                    </div>
                    <div class="info-group">
                        <label>Year Level:</label>
                        <p>{{ $student->year_level }}</p>
                    </div>
                    @if($student->user)
                        <div class="info-group">
                            <label>Account Status:</label>
                            <p><span class="status-badge status-{{ $student->user->status }}">
                                {{ ucfirst($student->user->status) }}
                            </span></p>
                        </div>
                        <div class="info-group">
                            <label>Last Login:</label>
                            <p>{{ $student->user->last_login_at ? \Carbon\Carbon::parse($student->user->last_login_at)->format('M d, Y h:i A') : 'Never' }}</p>
                        </div>
                    @endif
                </div>

                <!-- Enrollment Information Section -->
                <div class="profile-section">
                    <h3>Enrollment Information</h3>
                    <div class="info-group">
                        <label>Total Enrolled Subjects:</label>
                        <p>{{ $student->enrollments()->count() }}</p>
                    </div>
                    <div class="info-group">
                        <label>Current Semester Subjects:</label>
                        <p>{{ $student->enrollments()->where('semester', 'current')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
