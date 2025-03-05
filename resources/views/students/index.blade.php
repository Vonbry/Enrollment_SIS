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

        <!-- Pending Students Section -->
        @if($pendingStudents->count() > 0)
            <h3 class="section-subtitle">Pending Student Registrations</h3>
            <table id="pendingStudentsTable" class="management-table">
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
                    @foreach($pendingStudents as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->course ?? '-' }}</td>
                            <td>{{ $student->year_level ?? '-' }}</td>
                            <td class="actions">
                                <form action="{{ route('students.approve', $student->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn-approve">✓</button>
                                </form>
                                <form action="{{ route('students.decline', $student->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-decline">✕</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Registered Students Section -->
        <h3 class="section-subtitle">Registered Students</h3>
        <table id="registeredStudentsTable" class="management-table">
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
                        <td>{{ $student->student_number }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->year_level }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('students.show', $student->id) }}" class="btn-view">
                                    View
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn-edit">
                                    Edit
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this student?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#pendingStudentsTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search pending students..."
            }
        });

        $('#registeredStudentsTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[1, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search registered students..."
            }
        });
    });
</script>
@endpush
@endsection
