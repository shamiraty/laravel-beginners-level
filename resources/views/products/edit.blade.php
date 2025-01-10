@extends('layouts.app')

@section('content')
<div class="container mt-3 d-flex justify-content-center">
    <div class="card shadow-lg col-12 col-md-6 col-lg-6">
        <div class="card-header bg-primary text-white">
            <h6 class="card-title mb-0">Edit Product</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control @error('product_name') is-invalid @enderror" required>
                    @error('product_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="registered_date">Registered Date</label>
                    <input type="date" name="registered_date" value="{{ $product->registered_date }}" class="form-control @error('registered_date') is-invalid @enderror" required>
                    @error('registered_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="purchasing_price">Purchasing Price</label>
                    <input type="number" name="purchasing_price" value="{{ $product->purchasing_price }}" class="form-control @error('purchasing_price') is-invalid @enderror" step="0.01" required>
                    @error('purchasing_price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="selling_price">Selling Price</label>
                    <input type="number" name="selling_price" value="{{ $product->selling_price }}" class="form-control @error('selling_price') is-invalid @enderror" step="0.01" required>
                    @error('selling_price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $product->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                            <option value="{{ $region->id }}" {{ $product->region_id == $region->id ? 'selected' : '' }}>
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
                    <select name="district" class="form-control @error('district') is-invalid @enderror" required>
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ $product->district_id == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('district')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" name="expiry_date" value="{{ $product->expiry_date }}" class="form-control @error('expiry_date') is-invalid @enderror" required>
                    @error('expiry_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
