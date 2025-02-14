@extends('layouts.app')

@section('content')
    <div class="container1">
        <h1 class="h1">Add Student</h1>
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control1" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control1" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control1">
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control1">
            </div>
            <div class="mb-3">
                <label>Age</label>
                <input type="number" name="age" class="form-control1" required>
            </div> <br>
            <button type="submit" class="btn btn-success1">Save</button>
        </form>
    </div>
@endsection
