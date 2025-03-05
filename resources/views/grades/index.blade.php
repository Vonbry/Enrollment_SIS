@extends('layouts.app')
@section('content')
<div class="container">
    <div class="management-section">
        <div class="management-header">
            <h2 class="management-title">Grade Management</h2>
            <a href="{{ route('grades.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Add Grade
            </a>
        </div>

        <input type="text" class="search-box" placeholder="Search grades...">

        <table class="management-table">
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
                        <td>{{ $grade->midterm }}</td>
                        <td>{{ $grade->final }}</td>
                        <td>{{ $grade->semester }}</td>
                        <td>{{ number_format($grade->average, 2) }}</td>
                        <td>{{ $grade->us_grade }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('grades.show', $grade) }}" class="btn btn-view">
                                View
                            </a>
                            <a href="{{ route('grades.edit', $grade) }}" class="btn btn-edit">
                                Edit
                            </a>
                            <form id="delete-form-{{ $grade->id }}" action="{{ route('grades.destroy', $grade) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-delete" onclick="confirmDelete('delete-form-{{ $grade->id }}')">
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

