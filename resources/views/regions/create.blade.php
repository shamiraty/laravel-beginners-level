@extends('layouts.app')

@section('content')
<div class="container">
<div class="card">
<h6 class="card-header">Add Region</h6>
<div class="card-body"> 
    <form action="{{ route('regions.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Region Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('regions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</div>
</div>
@endsection
