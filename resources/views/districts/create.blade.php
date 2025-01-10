@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Add District</h4>
    <form action="{{ route('districts.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">District Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('districts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
