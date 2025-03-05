@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="management-section">
            <div class="management-header">
                <h2 class="management-title">Subject Management</h2>
                <a href="{{ route('subjects.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Add Subject
                </a>
            </div>

            <input type="text" class="search-box" placeholder="Search subjects...">

            <table class="management-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Units</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td>{{ $subject->code }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->units }}</td>
                            <td>
                                <span class="status-badge status-{{ $subject->status }}">
                                    {{ ucfirst($subject->status) }}
                                </span>
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('subjects.show', $subject) }}" class="btn btn-view">
                                    View
                                </a>
                                <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-edit">
                                    Edit
                                </a>
                                @if($subject->status !== 'verified')
                                    <form id="delete-form-{{ $subject->id }}" action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-delete" onclick="confirmDelete('delete-form-{{ $subject->id }}')">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

