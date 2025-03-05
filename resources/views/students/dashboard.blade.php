@extends('layouts.app')

@section('content')
<div class="student-dashboard">
    <div class="dashboard-header">
        <h1>Student Dashboard</h1>
        <p class="welcome-text">Welcome back, {{ Auth::user()->name }}!</p>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <i class="fas fa-book-reader stat-icon"></i>
            <div class="stat-info">
                <h3>Enrolled Subjects</h3>
                <p class="stat-number">{{ $grades->groupBy('subject.name')->count() }}</p>
            </div>
        </div>

        <div class="stat-card">
            <i class="fas fa-graduation-cap stat-icon"></i>
            <div class="stat-info">
                <h3>Current Year Level</h3>
                <p class="stat-number">{{ $student->year_level }}</p>
            </div>
        </div>

        <div class="stat-card">
            <i class="fas fa-university stat-icon"></i>
            <div class="stat-info">
                <h3>Course</h3>
                <p class="stat-number">{{ $student->course }}</p>
            </div>
        </div>

        <div class="stat-card">
            <i class="fas fa-chart-line stat-icon"></i>
            <div class="stat-info">
                <h3>Total Grades</h3>
                <p class="stat-number">{{ $grades->count() }}</p>
            </div>
        </div>

        <div class="stat-card gwa-card">
            <i class="fas fa-star stat-icon"></i>
            <div class="stat-info">
                <h3>Overall GWA</h3>
                <p class="stat-number">{{ number_format($gwa, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="grades-section">
        <div class="section-header">
            <h2>Your Grades</h2>
        </div>
        <div class="table-container">
            <table class="grades-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>1st Semester</th>
                        <th>2nd Semester</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grades->groupBy('subject.name') as $subjectName => $subjectGrades)
                        <tr>
                            <td>{{ $subjectName }}</td>
                            <td class="grade-cell">{{ number_format($subjectGrades->where('semester', '1st')->first()->average ?? 0, 2) }}</td>
                            <td class="grade-cell">{{ number_format($subjectGrades->where('semester', '2nd')->first()->average ?? 0, 2) }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower($subjectGrades->first()->us_grade) }}">
                                    {{ $subjectGrades->first()->us_grade }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
