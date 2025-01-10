<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Demo</title>
    <!-- Plugins: CSS -->
<link href="{{ asset('assets/bootstrap/css/ajax_cloudfare.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap/css/fonts.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap/css/datatable.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap/css/theme5.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap/css/ajax_jquery.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap/awesome/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap/awesome/css/fontawesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap/css/awaresome.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap/css/bootstrap_buttons.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style>
        body{
            font-family: 'Roboto', sans-serif;     
            color: #333;
        }
        #dataTable th, #dataTable td {
        border: 1px solid #dee2e6;
        padding: 8px; 
        text-align: left; 
    }
    canvas {
            height: 300px !important;
            width: 100% !important;
        }
        .card {
            margin: 10px;
        }
</style>
  </head>
   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('analytics.index') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                @auth
                    <!-- These links will only be visible if the user is authenticated -->
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('categories.index') }}">Categories
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('regions.index') }}">Regions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('districts.index') }}">Districts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>

                    <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">Users</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('departments.index') }}">Departments</a>
</li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <!-- If authenticated, show user name and role with logout link -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('profile.edit') }}">
                            <i class="fa fa-user-circle"></i> {{ Auth::user()->name }} ({{ Auth::user()->role->name }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('logout') }}">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                @else
                    <!-- If not authenticated, show login link -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">
                            <i class="fa fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <body class="bg-light">
    <div class="container mt-1 pt-2">   
                @yield('content')          
    </div>
    </body>
    <!-- Plugins: JS -->
<script src="{{ asset('assets/bootstrap/js/sweetalert.js') }}"></script>  
<script src="{{ asset('assets/bootstrap/js/jquery.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/jquery_ajax.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/jquery_datatable.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/datatable.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/datatable_ui.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/datatable_bootstrap.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap_buttons.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/datatable_zip.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/datatable_v2.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/datatable_copy.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/pdfmake/vfs_fonts.js') }}"></script>
    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle delete button click
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Display success or error messages
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @elseif(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
</html>
