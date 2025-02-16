@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Students List</h2>
        
        <!-- Add Student Button (Using Blade Component) -->
        <a href="{{ route('students.create') }}">
            <x-primary-button>Add Student</x-primary-button>
        </a>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <!-- Student Table with DataTables -->
        <div class="card mt-3">
            <div class="card-body">
                <table id="studentsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Semester</th>
                            <th>School Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->course }}</td>
                                <td>{{ $student->year_level }}</td>
                                <td>{{ $student->latest_semester }}</td>
                                <td>{{ $student->latest_school_year }}</td>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
