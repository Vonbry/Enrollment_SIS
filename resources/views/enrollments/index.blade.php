@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="management-section">
            <div class="management-header">
                <h2 class="management-title">Enrollment Management</h2>
                <a href="{{ route('enrollments.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Add Enrollment
                </a>
            </div>

            <input type="text" class="search-box" placeholder="Search enrollments...">

            <table class="management-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Semester</th>
                        <th>School Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->student->name }}</td>
                            <td>{{ $enrollment->subject->name }}</td>
                            <td>{{ $enrollment->semester }}</td>
                            <td>{{ $enrollment->school_year }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('enrollments.show', $enrollment) }}" class="btn btn-view">
                                    View
                                </a>
                                <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-edit">
                                    Edit
                                </a>
                                <form id="delete-form-{{ $enrollment->id }}" action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-delete" onclick="confirmDelete('delete-form-{{ $enrollment->id }}')">
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
