@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Grades List</h2>
        
        <!-- Add Student Button (Using Blade Component) -->
        <a href="{{ route('grades.create') }}">
            <x-primary-button>Add Grades</x-primary-button>
        </a>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <!-- Student Table with DataTables -->
        <div class="card mt-3">
            <div class="card-body">
                <table id="gradesTable" class="table table-bordered">
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
                        @foreach ($grades as $grade)
                            <tr>
                                <td>{{ $grade->student->name }}</td>
                                <td>{{ $grade->subject->name }}</td>
                                <td>{{ $grade->subject->units }}</td>
                                <td>
                                    @if($grade->midterm === 'INC')
                                        Incomplete
                                    @elseif($grade->midterm === 'D')
                                        Drop
                                    @elseif($grade->midterm === 'FDA')
                                        Failure Due to Absence
                                    @else
                                        {{ $grade->midterm ?? 'N/A' }}
                                    @endif
                                </td>
                                <td>
                                    @if($grade->final === 'INC')
                                        Incomplete
                                    @elseif($grade->final === 'D')
                                        Drop
                                    @elseif($grade->final === 'FDA')
                                        Failure Due to Absence
                                    @else
                                        {{ $grade->final ?? 'N/A' }}
                                    @endif
                                </td>
                                <td>{{ $grade->semester ?? 'N/A' }}</td>
                                <td>{{ $grade->average ?? 'N/A' }}</td>
                                <td>{{ $grade->us_grade ?? 'N/A' }}</td> 
                                <td>
                                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('grades.destroy', $grade) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete grade?')">
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

