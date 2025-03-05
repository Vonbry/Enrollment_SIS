@extends('layouts.app')
@section('content')
<div class="container">
    <div class="management-section">
        <div class="management-header">
            <h2 class="management-title">Grade Management</h2>
            <a href="{{ route('grades.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Add Grade
            </a>
            <a href="{{ route('report.grades') }}" class="btn btn-primary">Generate Grades Report</a>
        </div>

        <table id="gradesTable" class="display">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Units</th>
                    <th>Midterm</th>
                    <th>Final</th>
                    <th>Semester</th>
                    <th>Average</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                    <tr>
                        <td>{{ $grade->student->name }}</td>
                        <td>{{ $grade->subject->name }}</td>
                        <td>{{ $grade->subject->units }}</td>
                        <td>{{ number_format($grade->midterm, 2) }}</td>
                        <td>{{ number_format($grade->final, 2) }}</td>
                        <td>{{ $grade->semester }}</td>
                        <td>{{ number_format($grade->average, 2) }}</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($grade->us_grade) }}">
                                {{ $grade->us_grade }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('grades.show', $grade->id) }}" class="btn-view">View</a>
                                <a href="{{ route('grades.edit', $grade->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="inline-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this grade?')">
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
        var table = $('#gradesTable').DataTable({
            destroy: true,
            responsive: true,
            pageLength: 10,
            order: [[0, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search grades..."
            },
            columnDefs: [
                {
                    targets: -1, // Actions column
                    orderable: false
                },
                {
                    targets: [3, 4, 6], // Midterm, Final, and Average columns
                    render: function(data, type, row) {
                        if (type === 'display') {
                            return parseFloat(data).toFixed(2);
                        }
                        return data;
                    }
                }
            ]
        });
    });
</script>
@endpush
@endsection

