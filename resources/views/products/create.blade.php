@extends('layouts.app')

@section('content')
<div class="container mt-3 d-flex justify-content-center">
    <div class="card shadow-lg col-12 col-md-6 col-lg-6">
        <div class="card-header bg-primary text-white">
            <h6 class="card-title mb-0">Add Product</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}">
                    @error('product_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="registered_date">Registered Date</label>
                    <input type="date" name="registered_date" class="form-control @error('registered_date') is-invalid @enderror" value="{{ old('registered_date') }}">
                    @error('registered_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="purchasing_price">Purchasing Price</label>
                    <input type="number" name="purchasing_price" class="form-control @error('purchasing_price') is-invalid @enderror" step="0.01" value="{{ old('purchasing_price') }}">
                    @error('purchasing_price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="selling_price">Selling Price</label>
                    <input type="number" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" step="0.01" value="{{ old('selling_price') }}">
                    @error('selling_price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
    <label for="region">Region</label>
    <select name="region" class="form-control @error('region') is-invalid @enderror" required>
        <option value="">Select Region</option>
        @foreach ($regions as $region)
            <option value="{{ $region->id }}" {{ old('region') == $region->id ? 'selected' : '' }}>
                {{ $region->name }}
            </option>
        @endforeach
    </select>
    @error('region')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

                <div class="form-group mb-3">
                    <label for="district">District</label>
                    <select name="district" class="form-control @error('district') is-invalid @enderror">
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" {{ old('district') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                        @endforeach
                    </select>
                    @error('district')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror" value="{{ old('expiry_date') }}">
                    @error('expiry_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
