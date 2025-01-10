@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Role</h1>

        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Role</button>
        </form>
    </div>
@endsection
