@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Add New Department</h1>

        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save Department</button>
        </form>
    </div>
@endsection
