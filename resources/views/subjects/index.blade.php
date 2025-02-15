@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Subjects List</h2>
        
        <!-- Add Student Button (Using Blade Component) -->
        <a href="{{ route('subjects.create') }}">
            <x-primary-button>Add Subject</x-primary-button>
        </a>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <!-- Student Table with DataTables -->
        <div class="card mt-3">
            <div class="card-body">
                <table id="subjectsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Units</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->code }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->units }}</td>
                                <td>
                                    <a href="{{ route('subjects.show', $subject) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
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

