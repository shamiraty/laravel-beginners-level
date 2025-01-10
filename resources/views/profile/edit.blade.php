@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Profile Details</h2>
    {{-- Display success or error message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- User details --}}
    <div class="card mb-4">
        <div class="card-header">User Information</div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <i class="fa fa-user text-primary"></i> <strong>Name:</strong> {{ auth()->user()->name }}
                </li>
                <li class="list-group-item">
                    <i class="fa fa-envelope text-info"></i> <strong>Email:</strong> {{ auth()->user()->email }}
                </li>
                <li class="list-group-item">
                    <i class="fa fa-phone text-success"></i> <strong>Phone:</strong> {{ auth()->user()->phone }}
                </li>
                <li class="list-group-item">
                    <i class="fa fa-building text-secondary"></i> <strong>Department:</strong> {{ optional(auth()->user()->department)->name ?? 'Not assigned' }}
                </li>
                <li class="list-group-item">
                    <i class="fa fa-user-tag text-warning"></i> <strong>Role:</strong> {{ optional(auth()->user()->role)->name ?? 'Not assigned' }}
                </li>
            </ul>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">Change Password</div>
        <div class="card-body">
    {{-- Edit form for password --}}
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        {{-- Password field --}}
        <div class="form-group mt-3">
            <label for="password"><i class="fa fa-lock"></i> New Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Confirm Password field --}}
        <div class="form-group mt-3">
            <label for="password_confirmation"><i class="fa fa-lock"></i> Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            <i class="fa fa-save"></i> Save Changes
        </button>
    </form>
</div>
</div>
</div>

@endsection
