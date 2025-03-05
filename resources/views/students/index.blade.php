@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="management-section">
            <div class="management-header">
                <h2 class="management-title">Student Management</h2>
                <a href="{{ route('students.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Add Student
                </a>
            </div>

            <input type="text" class="search-box" placeholder="Search students...">

            <!-- Pending Students Section -->
            @if($pendingStudents->count() > 0)
                <h3 class="section-subtitle">Pending Student Registrations</h3>
                <table class="management-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingStudents as $pending)
                            <tr>
                                <td>{{ $pending->name }}</td>
                                <td>{{ $pending->email }}</td>
                                <td>{{ $pending->course }}</td>
                                <td>{{ $pending->year_level }}</td>
                                <td class="action-buttons">
                                    <form action="{{ route('students.approve', $pending->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form id="decline-form-{{ $pending->id }}" action="{{ route('students.decline', $pending->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-decline" onclick="confirmDelete('decline-form-{{ $pending->id }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <!-- Registered Students Section -->
            <h3 class="section-subtitle">Registered Students</h3>
            <table class="management-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->year_level }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-view">
                                    View
                                </a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-edit">
                                    Edit
                                </a>
                                <form id="delete-form-{{ $student->id }}" action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-delete" onclick="confirmDelete('delete-form-{{ $student->id }}')">
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
@endsection
