<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
   
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
               @yield('content')
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script href="{{ asset('js/custom.js') }}"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script>
            document.getElementById('semester').addEventListener('change', function() {
                let semester = this.value;
                document.getElementById('midterm-section').style.display = (semester === '1st') ? 'block' : 'none';
                document.getElementById('final-section').style.display = (semester === '2nd') ? 'block' : 'none';
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#studentsTable').DataTable();
            });
        </script>
         <script>
            $(document).ready(function() {
                $('#subjectsTable').DataTable();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#enrollmentsTable').DataTable();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#gradesTable').DataTable();
            });
        </script>
        
    </body>
</html>
