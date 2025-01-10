@extends('layouts.app')

@section('content')
<div class="container mt-3 d-flex justify-content-center">
    <div class="card shadow-lg col-12 col-md-8 col-lg-6">
        <div class="card-header bg-primary text-white">
            <h6 class="card-title mb-0">Edit User</h6>
        </div>
        <div class="card-body">
            <!-- Edit User Form -->
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Full Name -->
                <div class="form-group mb-3">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="form-group mb-3">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required>
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Department -->
                <div class="form-group mb-3">
                    <label for="department_id">Department</label>
                    <select name="department_id" class="form-control @error('department_id') is-invalid @enderror" required>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Role -->
                <div class="form-group mb-3">
                    <label for="role_id">Role</label>
                    <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
