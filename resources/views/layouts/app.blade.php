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
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
   
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

        <!-- Custom CSS -->
        <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="{{ asset('js/dashboard.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <!-- DataTables JS -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        
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
        <script>
            $(document).ready(function() {
                $('#usersTable').DataTable();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#gradesDashboard').DataTable();
            });
        </script>
        @if(session('success'))
            <script>
                showFlashMessage("{{ session('success') }}", 'success');
            </script>
        @endif

        @if(session('error'))
            <script>
                showFlashMessage("{{ session('error') }}", 'error');
            </script>
        @endif

        @stack('scripts')
    </body>
</html>