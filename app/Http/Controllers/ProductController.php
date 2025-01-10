<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\District;
use App\Models\Region;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade as PDF;
use ZipArchive;
class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products
        $products = Product::all();
    
        // Fetch unique categories, statuses, regions, and districts
        $categories = Product::select('category')->distinct()->get();
        $statuses = Product::select('status')->distinct()->get();
        $regions = Product::select('region')->distinct()->get();
        $districts = Product::select('district')->distinct()->get();
    
        // Return view with products, categories, statuses, regions, and districts
        return view('products.index', compact('products', 'categories', 'statuses', 'regions', 'districts'));
    }
    
    
    public function create()
{
    $categories = Category::all();
    $regions = Region::all();
    $districts = District::all();
    return view('products.create', compact('categories','regions', 'districts'));
}


    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'registered_date' => 'required|date',
            'purchasing_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'status' => 'required|string',
            'region' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'expiry_date' => 'required|date',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $regions = Region::all();
        $districts = District::all();
        return view('products.edit', compact('product', 'categories', 'districts','regions'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'registered_date' => 'required|date',
            'purchasing_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'status' => 'required|string',
            'region' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'expiry_date' => 'required|date',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function show(Product $product)
{
    return view('products.show', compact('product'));
}


public function exportCsv(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $frequency = $request->input('frequency');
    $category = $request->input('category');
    $status = $request->input('status');
    $region = $request->input('region');
    $district = $request->input('district');

    // Calculate start and end dates based on frequency
    if ($frequency) {
        $now = Carbon::now();

        switch ($frequency) {
            case 'weekly':
                $startDate = $now->startOfWeek()->toDateString();
                $endDate = $now->endOfWeek()->toDateString();
                break;
            case 'monthly':
                $startDate = $now->startOfMonth()->toDateString();
                $endDate = $now->endOfMonth()->toDateString();
                break;
            case 'yearly':
                $startDate = $now->startOfYear()->toDateString();
                $endDate = $now->endOfYear()->toDateString();
                break;
            case 'quarterly_q1':
                $startDate = $now->startOfYear()->toDateString();
                $endDate = $now->month(3)->endOfMonth()->toDateString();
                break;
            case 'quarterly_q2':
                $startDate = $now->month(4)->startOfMonth()->toDateString();
                $endDate = $now->month(6)->endOfMonth()->toDateString();
                break;
            case 'quarterly_q3':
                $startDate = $now->month(7)->startOfMonth()->toDateString();
                $endDate = $now->month(9)->endOfMonth()->toDateString();
                break;
            case 'quarterly_q4':
                $startDate = $now->month(10)->startOfMonth()->toDateString();
                $endDate = $now->endOfYear()->toDateString();
                break;
            case 'half_year_1_6':
                $startDate = $now->startOfYear()->toDateString();
                $endDate = $now->month(6)->endOfMonth()->toDateString(); 
                break;
            case 'half_year_6_12':
                $startDate = $now->month(7)->startOfMonth()->toDateString();
                $endDate = $now->endOfYear()->toDateString();
                break;
        }
    }

    // Fetch data with filters
    $productsQuery = Product::query();

    if ($startDate && $endDate) {
        $productsQuery->whereBetween('registered_date', [$startDate, $endDate]);
    }

    if ($category) {
        $productsQuery->where('category', $category);
    }

    if ($status) {
        $productsQuery->where('status', $status);
    }

    if ($region) {
        $productsQuery->where('region', $region);
    }

    if ($district) {
        $productsQuery->where('district', $district);
    }

    $products = $productsQuery->get();

    // Create a streamed response for CSV export
    $response = new StreamedResponse(function () use ($products) {
        // Open output stream
        $handle = fopen('php://output', 'w');

        // Write CSV headers
        fputcsv($handle, [
            'Product Name', 'Registered Date', 'Purchasing Price', 'Selling Price', 'Category', 'Status', 'Region', 'District', 'Expiry Date'
        ]);

        // Write data to CSV
        foreach ($products as $product) {
            fputcsv($handle, [
                $product->product_name,
                $product->registered_date,
                $product->purchasing_price,
                $product->selling_price,
                $product->category,
                $product->status,
                $product->region,
                $product->district,
                $product->expiry_date
            ]);
        }

        // Close output stream
        fclose($handle);
    });

    // Set headers for the response
    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', 'attachment; filename="products_export.csv"');

    return $response;
}
}
