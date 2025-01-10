@extends('layouts.app')

@section('content')
<div class="container mt-3">




<div class="row mt-4">
    <!-- Number of Users by Role -->
    @foreach($roleCounts as $role)
    <div class="col-md-2"> <!-- Reduced column size -->
        <div class="card shadow-sm text-center mt-2"> <!-- Reduced shadow and padding -->
            <div class="card-body p-2"> <!-- Reduced padding inside the card -->
                <h5 class="card-title">
                    <i class="fa fa-users fa-lg text-info"></i><br> <!-- Reduced icon size -->
                    {{ $role->role->name }}  <!-- Display role name -->
                </h5>
                <h3 class="mb-1">{{ $role->users_count }}</h3>  <!-- Display user count with reduced bottom margin -->
                <p class="mb-0">Users</p> <!-- Reduced margin at the bottom of text -->
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row mt-4">
    <!-- Number of Users by Department -->
    @foreach($departmentCounts as $department)
    <div class="col-md-2"> <!-- Reduced column size -->
        <div class="card shadow-sm text-center mt-2"> <!-- Reduced shadow and padding -->
            <div class="card-body p-2"> <!-- Reduced padding inside the card -->
                <h5 class="card-title">
                    <i class="fa fa-building fa-lg text-primary"></i><br> <!-- Reduced icon size -->
                    {{ $department->department->name }}  <!-- Display department name -->
                </h5>
                <h3 class="mb-1">{{ $department->users_count }}</h3>  <!-- Display user count with reduced bottom margin -->
                <p class="mb-0">Users</p> <!-- Reduced margin at the bottom of text -->
            </div>
        </div>
    </div>
    @endforeach
</div>




<div class="card shadow-lg mt-3">
<div class="card-body">
    <div class="row">
        <!-- Registration Form (Left Column) -->
        <div class="col-12 col-md-4">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h6 class="card-title mb-0">Register User</h6>
                </div>
                <div class="card-body">
                    <!-- Registration Form -->
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <!-- Full Name -->
                        <div class="form-group mb-3">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" >
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group mb-3">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="form-group mb-3">
                            <label for="department_id">Department</label>
                            <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="form-group mb-3">
                            <label for="role_id">Role</label>
                            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table of Registered Users (Right Column) -->
        <div class="col-12 col-md-8">
        <div class="card">
        <div class="card-body">
            <h4>Registered Users</h4>
            <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->role->name }}</td>
                                    <!-- Action Buttons -->
                                   <td> <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
                                   <td> <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">View</a></td>
                                   <td> <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            paging: true,
            searching: false,
            ordering: true,
            info: true,
            pageLength: 10
        });
    });
</script>
@endsection
