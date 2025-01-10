@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header">
            <h6>Product Details</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Product Name:</th>
                        <td>{{ $product->product_name }}</td>
                    </tr>
                    <tr>
                        <th>Registered Date:</th>
                        <td>{{ $product->registered_date }}</td>
                    </tr>
                    <tr>
                        <th>Purchasing Price:</th>
                        <td>{{ $product->purchasing_price }}</td>
                    </tr>
                    <tr>
                        <th>Selling Price:</th>
                        <td>{{ $product->selling_price }}</td>
                    </tr>
                    <tr>
                        <th>Profit:</th>
                        <td>{{ $product->profit }}</td>
                    </tr>
                    <tr>
                        <th>Category:</th>
                        <td>{{ $product->category }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>{{ $product->status }}</td>
                    </tr>
                    <tr>
                        <th>Region:</th>
                        <td>{{ $product->region }}</td>
                    </tr>
                    <tr>
                        <th>District:</th>
                        <td>{{ $product->district }}</td>
                    </tr>
                    <tr>
                        <th>Expiry Date:</th>
                        <td>{{ $product->expiry_date }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm mt-3">Back to Products</a>
        </div>
    </div>
</div>
@endsection
