@extends('layouts.app')
@section('content')
<div class="card shadow-lg">
    <div class="card-header fw-bold text-uppercase">Filter Report and Product Table</div>
    <div class="card-body">
        <div class="row">
            <!-- Filter Section -->
            <div class="col-md-4">
            <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('products.export') }}" method="GET" class="mb-4">
                    <div class="form-group">
                        <label for="start_date" class=""><small>Filter by Start Date</small></label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="end_date" class=""><small>Filter by End Date</small></label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="frequency" class=""><small>Filter by Frequency</small></label>
                        <select name="frequency" id="frequency" class="form-control select2">
                            <option value="">All</option>
                            <option value="weekly" {{ request('frequency') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            <option value="monthly" {{ request('frequency') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="yearly" {{ request('frequency') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            <option value="quarterly_q1" {{ request('frequency') == 'quarterly_q1' ? 'selected' : '' }}>Quarterly (Q1: Jan - Mar)</option>
                            <option value="quarterly_q2" {{ request('frequency') == 'quarterly_q2' ? 'selected' : '' }}>Quarterly (Q2: Apr - Jun)</option>
                            <option value="quarterly_q3" {{ request('frequency') == 'quarterly_q3' ? 'selected' : '' }}>Quarterly (Q3: Jul - Sep)</option>
                            <option value="quarterly_q4" {{ request('frequency') == 'quarterly_q4' ? 'selected' : '' }}>Quarterly (Q4: Oct - Dec)</option>
                            <option value="half_year_1_6" {{ request('frequency') == 'half_year_1_6' ? 'selected' : '' }}>Half Year (1-6 months)</option>
                            <option value="half_year_6_12" {{ request('frequency') == 'half_year_6_12' ? 'selected' : '' }}>Half Year (6-12 months)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category" class=""><small>Filter by Category</small></label>
                        <select name="category" id="category" class="form-control">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status" class=""><small>Filter by Status</small></label>
                        <select name="status" id="status" class="form-control">
                            <option value="">All</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->status }}" {{ request('status') == $status->status ? 'selected' : '' }}>{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="region" class=""><small>Filter by Region</small></label>
                        <select name="region" id="region" class="form-control">
                            <option value="">All</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->region }}" {{ request('region') == $region->region ? 'selected' : '' }}>{{ $region->region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="district" class=""><small>Filter by District</small></label>
                        <select name="district" id="district" class="form-control">
                            <option value="">All</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->district }}" {{ request('district') == $district->district ? 'selected' : '' }}>{{ $district->district }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-3">Export CSV Report</button>
                </form>
            </div>
            </div>
            </div>
            <!-- Product Table Section -->
            <div class="col-md-8">
            <div class="card">
            <div class="card-body">
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mb-3">Add Product</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Product Name</th>
                                <th>Purchasing Price</th>
                                <th>Selling Price</th>
                                <th>Edit</th>
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td class="">{{ $product->product_name }}</td>
                                <td>{{ $product->purchasing_price }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-primary btn-sm btn-delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            paging: true,
            searching: false,
            ordering: true,
            info: true,
            pageLength: 10
        });
    });
</script>

@endsection
