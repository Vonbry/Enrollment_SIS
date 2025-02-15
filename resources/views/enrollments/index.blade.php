@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Enrollments List</h2>
        
        <!-- Add Student Button (Using Blade Component) -->
        <a href="{{ route('enrollments.create') }}">
            <x-primary-button>Add Enrollment</x-primary-button>
        </a>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <!-- Student Table with DataTables -->
        <div class="card mt-3">
            <div class="card-body">
                <table id="enrollmentsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Units</th>
                            <th>School Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $enrollment)
                            <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>{{ $enrollment->student->name }}</td>
                            <td>{{ $enrollment->subject->name }}</td>
                            <td>{{ $enrollment->semester }}</td>
                            <td>{{ $enrollment->school_year }}</td>
                                <td>
                                    <a href="{{ route('enrollments.show', $enrollment) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" class="d-inline">
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
