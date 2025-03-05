@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Header Section -->
    <div class="dashboard-header">
        <h1>Student Dashboard</h1>
        <p class="welcome-text">Welcome back, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-info">
                <h3>Enrolled Subjects</h3>
                <p class="stat-value">4</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-info">
                <h3>Current Year Level</h3>
                <p class="stat-value">3</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-university"></i>
            </div>
            <div class="stat-info">
                <h3>Course</h3>
                <p class="stat-value">IT</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-info">
                <h3>Total Grades</h3>
                <p class="stat-value">8</p>
            </div>
        </div>
    </div>

    <!-- GWA Card -->
    <div class="gwa-card">
        <div class="gwa-icon">
            <i class="fas fa-star"></i>
        </div>
        <div class="gwa-info">
            <h3>Overall GWA</h3>
            <p class="gwa-value">2.06</p>
        </div>
    </div>

    <!-- Grades Table -->
    <div class="grades-section">
        <h2>Your Grades</h2>
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
                    <tr>
                        <td>App devs</td>
                        <td>2.00</td>
                        <td>2.00</td>
                        <td><span class="badge passed">Passed</span></td>
                    </tr>
                    <tr>
                        <td>Capstone and Research 2</td>
                        <td>1.25</td>
                        <td>1.50</td>
                        <td><span class="badge passed">Passed</span></td>
                    </tr>
                    <tr>
                        <td>HCI</td>
                        <td>1.50</td>
                        <td>1.50</td>
                        <td><span class="badge passed">Passed</span></td>
                    </tr>
                    <tr>
                        <td>WEBSYSs</td>
                        <td>2.75</td>
                        <td>4.00</td>
                        <td><span class="badge failed">Failed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection 