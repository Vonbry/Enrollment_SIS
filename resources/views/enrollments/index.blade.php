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

            <table id="enrollmentsTable" class="display">
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
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('enrollments.show', $enrollment->id) }}" class="btn-view">View</a>
                                    <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn-edit">Edit</a>
                                    <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this enrollment?')">
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
            var table = $('#enrollmentsTable').DataTable({
                destroy: true,
                responsive: true,
                pageLength: 10,
                order: [[0, 'asc']],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search enrollments..."
                },
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false
                    }
                ]
            });
        });
    </script>
@endpush
@endsection
