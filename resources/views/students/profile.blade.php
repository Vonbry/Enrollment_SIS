@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-form-container">
        <h2>Profile Information</h2>
        
        <form method="POST" action="{{ route('profile.update') }}" class="profile-form">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $student->phone) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address', $student->address) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" value="{{ old('age', $student->age) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="year_level">Year Level</label>
                <input type="number" id="year_level" name="year_level" value="{{ old('year_level', $student->year_level) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="course">Course</label>
                <input type="text" id="course" value="{{ $student->course }}" class="form-control" readonly disabled>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>
@endsection 