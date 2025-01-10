@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Categories</h4>
    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Add Category</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline-block;">
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
