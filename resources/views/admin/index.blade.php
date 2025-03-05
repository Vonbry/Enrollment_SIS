@extends('layouts.app')
@section('content')
<div class="admin-dashboard">
    <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <p class="welcome-text">Welcome back, {{ Auth::user()->name }}!</p>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h3>Total Students</h3>
            <p>{{ $totalStudents }}</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-book"></i>
            <h3>Total Subjects</h3>
            <p>{{ $totalSubjects }}</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-user-graduate"></i>
            <h3>Active Enrollments</h3>
            <p>{{ $totalEnrollments }}</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-chart-bar"></i>
            <h3>Total Grades</h3>
            <p>{{ $totalGrades }}</p>
        </div>
    </div>

    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="quick-actions-grid">
            <a href="{{ route('students.index') }}" class="action-card students-card">
                <i class="fas fa-users"></i>
                <span>Manage Students</span>
            </a>
            <a href="{{ route('subjects.index') }}" class="action-card subjects-card">
                <i class="fas fa-book"></i>
                <span>Manage Subjects</span>
            </a>
            <a href="{{ route('enrollments.index') }}" class="action-card enrollments-card">
                <i class="fas fa-user-graduate"></i>
                <span>Manage Enrollments</span>
            </a>
            <a href="{{ route('grades.index') }}" class="action-card grades-card">
                <i class="fas fa-chart-bar"></i>
                <span>Manage Grades</span>
            </a>
        </div>
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
