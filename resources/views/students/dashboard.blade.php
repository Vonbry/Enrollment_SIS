@extends('layouts.app')

@section('content')
<div class="container">
   

    <h2>Student Dashboard</h2>
    <p>Welcome, {{ Auth::user()->name }}! Here are your grades:</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Midterm</th>
                <th>Final</th>
                <th>Average</th>
                <th>Description</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->subject->name }}</td>
                    <td>{{ $grade->midterm ?? 'N/A' }}</td>
                    <td>{{ $grade->final ?? 'N/A' }}</td>
                    <td>{{ $grade->average ?? 'N/A' }}</td>
                    <td>{{ $grade->description ?? 'N/A' }}</td>
                    <td>{{ $grade->us_grade ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
