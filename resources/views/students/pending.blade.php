@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pending-approval">
        <div class="pending-header">
            <i class="fas fa-clock-o pending-icon"></i>
            <h1>Account Pending Approval</h1>
        </div>

        <div class="pending-content">
            <div class="welcome-message">
                <h2>Welcome, {{ Auth::user()->name }}!</h2>
                <p class="status-text">Your account is currently pending administrator approval.</p>
            </div>

            <div class="info-card">
                <div class="info-section">
                    <i class="fas fa-info-circle info-icon"></i>
                    <div class="info-text">
                        <h3>What's Next?</h3>
                        <p>Please wait while an administrator reviews your registration. This process may take some time.</p>
                    </div>
                </div>

                <div class="info-section">
                    <i class="fas fa-check-circle info-icon"></i>
                    <div class="info-text">
                        <h3>After Approval</h3>
                        <p>You will be able to access your student dashboard once your account has been approved.</p>
                    </div>
                </div>

                <div class="info-section">
                    <i class="fas fa-question-circle info-icon"></i>
                    <div class="info-text">
                        <h3>Need Help?</h3>
                        <p>If you have any questions, please contact the administrator.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 