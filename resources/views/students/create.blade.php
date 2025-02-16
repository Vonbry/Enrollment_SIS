@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Student Form -->
             <div class="container1">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                    <h1 class="h1">Add Students</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('students.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control1" required>
                            </div>
                            <!-- <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Age</label>
                                <input type="number" name="age" class="form-control1" required>
                            </div> -->

                            <!-- Year Level Dropdown -->
                            <div class="mb-3">
                                <label for="year_level" class="form-label">Year Level</label>
                                <select name="year_level" class="form-control" required>
                                    <option value="" disabled selected>Select Year Level</option>
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}">{{ $i }} Year</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Course Dropdown -->
                            <div class="mb-3">
                                <label for="course" class="form-label">Course</label>
                                <select name="course" class="form-control" required>
                                    <option value="" disabled selected>Select Course</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSCS">BSCS</option>
                                    <option value="BSCE">BSCE</option>
                                    <option value="BSEd">BSEd</option>
                                    <option value="BSBA">BSBA</option>
                                </select>
                            </div>

                            <div class="button-group">
                                <x-primary-button type="submit">Add Students</x-primary-button>
                                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!-- Student List Table -->
            <div class="container2 col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                    <h1 class="h1">Lists of Student Role Account</h1>
                    </div>
                    <div class="card-body">
                        <table id="usersTable" class="table table-bordered">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Year Level</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\User::where('role', 'student')->get() as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->year_level ?? 'N/A' }}</td>
                                        <td>{{ $student->course ?? 'N/A' }}</td>
                                        <td>{{ $student->status }}</td>
                                    </tr>
                                @endforeach
                                @if (\App\Models\User::where('role', 'student')->count() == 0)
                                    <tr>
                                        <td colspan="5" class="text-muted">No students found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
