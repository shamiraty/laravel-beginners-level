@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Districts</h4>
    <a href="{{ route('districts.create') }}" class="btn btn-success mb-3">Add District</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($districts as $district)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $district->name }}</td>
                <td>
                    <a href="{{ route('districts.edit', $district) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('districts.destroy', $district) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
