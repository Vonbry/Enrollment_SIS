@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3>Welcome, Admin!</h3>
                <p>This is your dashboard where you can manage students, subjects, enrollments, and grades.</p>

                <!-- Button to go to Student Management -->
                <a href="{{ route('students.index') }}">
                    <x-primary-button class="mt-4">
                        Manage Students
                    </x-primary-button>
                </a>
            </div>
        </div>
    </div>
@endsection

