<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h4>User Details</h4>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
            <p><strong>Department:</strong> {{ $user->department->name }}</p>
            <p><strong>Role:</strong> {{ $user->role->name }}</p>
        </div>
    </div>
</div>
@endsection
