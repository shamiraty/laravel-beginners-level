@extends('layouts.app')

@section('content')
<div class="container mt-3 d-flex justify-content-center">
    <div class="card shadow-lg col-12 col-md-6 col-lg-4">
        <div class="card-header bg-primary text-white text-center text-uppercase">
            <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo" class="img-fluid mb-3" style="max-width: 200px;">
            <h6 class="card-title mb-0">Welcome to the Platform</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="email">Username</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3 position-relative">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                    <i class="fa fa-eye-slash position-absolute" id="togglePassword" style="top: 35px; right: 15px; cursor: pointer;"></i>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
        <div class="card-footer">
            <code  class="fw-bold">Username:  demo@gmail.com</code><br>
            <code class="fw-bold">Password:  demo2025</code>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function (e) {
        // Toggle the password field visibility
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;

        // Toggle the eye icon class
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>
@endsection
