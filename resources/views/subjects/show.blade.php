@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="subject-details">
            <div class="details-header">
                <h2>Subject Details</h2>
                <a href="{{ route('subjects.index') }}" class="btn btn-back">Back to List</a>
            </div>

            <div class="details-content">
                <div class="info-group">
                    <label>Code:</label>
                    <p>{{ $subject->code }}</p>
                </div>
                <div class="info-group">
                    <label>Name:</label>
                    <p>{{ $subject->name }}</p>
                </div>
                <div class="info-group">
                    <label>Units:</label>
                    <p>{{ $subject->units }}</p>
                </div>
                <div class="info-group">
                    <label>Status:</label>
                    <p><span class="status-badge status-{{ $subject->status }}">{{ ucfirst($subject->status) }}</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection
