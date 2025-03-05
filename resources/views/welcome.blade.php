@extends('layouts.welcome')

@section('content')
<div class="welcome-container">
    <div class="hero-section">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        </div>
        <h1>Student Information System</h1>
        <p class="subtitle">Manage student records, enrollments, and grades efficiently</p>
        
        <div class="auth-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route(auth()->user()->role === 'admin' ? 'admin-dashboard' : 'student-dashboard') }}" 
                       class="btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-secondary">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <div class="features-section">
        <h2>Key Features</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-user-graduate"></i>
                <h3>Student Management</h3>
                <p>Efficiently manage student profiles and academic records</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-book"></i>
                <h3>Course Management</h3>
                <p>Handle course offerings and subject enrollments</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-chart-line"></i>
                <h3>Grade Tracking</h3>
                <p>Monitor academic performance and generate reports</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-clipboard-check"></i>
                <h3>Enrollment System</h3>
                <p>Streamline the enrollment process for students</p>
            </div>
        </div>
    </div>
</div>

<style>
.welcome-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 2rem;
}

.hero-section {
    text-align: center;
    padding: 4rem 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.logo-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 2rem;
}

.logo {
    width: 200px;
    height: auto;
}

h1 {
    font-size: 2.5rem;
    color: #2d3748;
    margin-bottom: 1rem;
}

.subtitle {
    font-size: 1.25rem;
    color: #4a5568;
    margin-bottom: 2rem;
}

.auth-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.btn-primary, .btn-secondary {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #3498db;
    color: white;
}

.btn-primary:hover {
    background-color: #2980b9;
}

.btn-secondary {
    background-color: white;
    color: #3498db;
    border: 2px solid #3498db;
}

.btn-secondary:hover {
    background-color: #f8fafc;
}

.features-section {
    max-width: 1200px;
    margin: 4rem auto;
    padding: 2rem;
}

.features-section h2 {
    text-align: center;
    font-size: 2rem;
    color: #2d3748;
    margin-bottom: 3rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-card i {
    font-size: 2.5rem;
    color: #3498db;
    margin-bottom: 1rem;
}

.feature-card h3 {
    color: #2d3748;
    margin-bottom: 1rem;
}

.feature-card p {
    color: #4a5568;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 2rem 1rem;
    }

    h1 {
        font-size: 2rem;
    }

    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
