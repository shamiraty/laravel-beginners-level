@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Add Category</h4>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
