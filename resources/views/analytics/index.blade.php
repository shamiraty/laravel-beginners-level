@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold mb-4 text-secondary">Inventory Management System Demo</h4>
        </div>
    </div>

    <div class="row">
        <!-- Metric Cards -->
        @php
            $cards = [
                ['icon' => 'fas fa-globe-americas', 'count' => $regionsCount, 'title' => 'Regions'],
                ['icon' => 'fas fa-map-marked-alt', 'count' => $districtsCount, 'title' => 'Districts'],
                ['icon' => 'fas fa-list-alt', 'count' => $categoriesCount, 'title' => 'Categories'],
                ['icon' => 'fas fa-cogs', 'count' => $productsCount, 'title' => 'Products'],
            ];
        @endphp

        @foreach ($cards as $card)
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow rounded-lg bg-light border-secondary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="{{ $card['icon'] }} fa-3x text-info"></i>
                        <div class="text-right">
                            <h3 class="font-weight-bold text-dark">{{ $card['count'] }}</h3>
                            <h6 class="font-weight-medium text-muted">{{ $card['title'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <hr class="my-4">

    <div class="row">
        <!-- Analytics Cards -->
        @php
            $analytics = [
                ['icon' => 'fas fa-dollar-sign', 'value' => number_format($purchasingPriceSum, 2), 'title' => 'Total Purchasing Price'],
                ['icon' => 'fas fa-tags', 'value' => number_format($sellingPriceSum, 2), 'title' => 'Total Selling Price'],
                ['icon' => 'fas fa-check-circle', 'value' => $statusCount, 'title' => 'Active Products'],
                ['icon' => 'fas fa-chart-line', 'value' => number_format($statusSum, 2), 'title' => 'Total Active Products Price'],
            ];
        @endphp

        @foreach ($analytics as $analytic)
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow rounded-lg bg-light border-light">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="{{ $analytic['icon'] }} fa-3x text-info"></i>
                        <div class="text-right">
                            <h3 class="font-weight-bold text-dark">Tsh{{ $analytic['value'] }}</h3>
                            <h6 class="font-weight-medium text-muted">{{ $analytic['title'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <hr class="my-4">

    <div class="row">
        <!-- Expiry Analytics Section -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card shadow rounded-lg bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-exclamation-triangle fa-3x"></i>
                        <div class="text-right">
                            <h3 class="font-weight-bold">{{ $expiringTodayOrLaterCount }} Products</h3>
                            <h6 class="font-weight-medium">Expiring Today or Later</h6>
                            <p class="font-weight-light">Total Selling Price: Tsh{{ number_format($expiringTodayOrLaterSum, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Bar Chart -->
        <div class="col-md-6">
            <div class="card shadow rounded-lg bg-light">
                <p class="card-header text-center font-weight-bold">Trends of Selling Price by Month</p>
                <div class="card-body">
                    <canvas id="sellingPriceTrendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="col-md-6">
            <div class="card shadow rounded-lg bg-light">
                <p class="card-header text-center font-weight-bold">Product Category Frequency</p>
                <div class="card-body">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Donut Chart Data and Initialization
    const categoryData = @json($categoryFrequency); // PHP data
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: categoryData.map(item => item.category),
            datasets: [{
                data: categoryData.map(item => item.count),
                backgroundColor: categoryData.map(() => `#${Math.floor(Math.random() * 16777215).toString(16)}`),
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' },
                datalabels: {
                    color: '#fff',
                    formatter: (value, ctx) => `${ctx.chart.data.labels[ctx.dataIndex]}: ${value}`
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        },
        plugins: [ChartDataLabels]
    });

    // Bar Chart Data and Initialization
    const sellingPriceTrend = @json($sellingPriceTrend); // PHP data
    const barCtx = document.getElementById('sellingPriceTrendChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: sellingPriceTrend.map(item => `Month ${item.month}`),
            datasets: [{
                label: 'Total Selling Price',
                data: sellingPriceTrend.map(item => item.total_selling_price),
                backgroundColor: 'rgba(0, 41, 244, 0.5)',
                borderColor: 'rgb(0, 41, 244)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true },
            },
            plugins: {
                legend: { display: true },
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
</body>
</html>


@endsection
