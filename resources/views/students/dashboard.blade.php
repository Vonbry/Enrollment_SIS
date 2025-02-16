@extends('layouts.app')

@section('content')
<div class="container3">
   

    <h1 class="h1">Student Dashboard</h1>
    <p class="p1">Welcome, {{ Auth::user()->name }}! Here are your grades:</p>

    <table id="gradesDashboard" class="table table-bordered">
        <thead>
            <tr>
                <th>Subject Code</th>
                <th>Subject</th>
                <th>Midterm</th>
                <th>Final</th>
                <th>Average</th>
                <th>Semester</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->subject ? $grade->subject->code : 'N/A' }}</td> <!-- Fix for Subject Code -->
                    <td>{{ $grade->subject ? $grade->subject->name : 'N/A' }}</td>
                    <td>{{ $grade->midterm ?? 'N/A' }}</td>
                    <td>{{ $grade->final ?? 'N/A' }}</td>
                    <td>{{ $grade->average ?? 'N/A' }}</td>
                    <td>{{ $grade->semester ?? 'N/A' }}</td>
                    <td>{{ $grade->us_grade ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
