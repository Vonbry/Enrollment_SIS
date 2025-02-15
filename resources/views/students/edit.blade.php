@extends('layouts.app')
@section('content')
    <div class="container1">
        <h1 class="h1">Edit Student</h1>
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control1" value="{{ $student->name }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control1" value="{{ $student->email }}" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control1" value="{{ $student->phone }}">
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control1" value="{{ $student->address }}">
            </div>
            <div class="mb-3">
                <label>Age</label>
                <input type="number" name="age" class="form-control1" value="{{ $student->age }}" required>
            </div> <br>
            <x-primary-button type="submit">Update Student</x-primary-button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection