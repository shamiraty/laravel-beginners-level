@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Regions</h4>
    <a href="{{ route('regions.create') }}" class="btn btn-primary mb-3">Add Region</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regions as $region)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $region->name }}</td>
                <td>
                    <a href="{{ route('regions.edit', $region) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('regions.destroy', $region) }}" method="POST" style="display: inline-block;">
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
