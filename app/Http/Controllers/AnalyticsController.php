<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\District;
use App\Models\Product;
use App\Models\Region;
use Illuminate\Http\Request;
class AnalyticsController extends Controller
{
    public function index()
    {
        // Counts
        $regionsCount = Region::count();
        $districtsCount = District::count();
        $categoriesCount = Category::count();
        $productsCount = Product::count();

        // Product Summaries
        $purchasingPriceSum = Product::sum('purchasing_price');
        $sellingPriceSum = Product::sum('selling_price');
        $statusCount = Product::where('status', 'active')->count();
        $statusSum = Product::where('status', 'active')->sum('selling_price');

        // Products expiring today or after today
        $expiringTodayOrLaterCount = Product::where('expiry_date', '>=', now())->count();
        $expiringTodayOrLaterSum = Product::where('expiry_date', '>=', now())->sum('selling_price');

        // Bar graph data for 'selling_price' trend by month
        $sellingPriceTrend = Product::selectRaw('MONTH(expiry_date) as month, SUM(selling_price) as total_selling_price')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        // Frequency of products by category
        $categoryFrequency = Product::select('category', \DB::raw('COUNT(*) as count'))
       ->groupBy('category')
       ->get();

        return view('analytics.index', compact(
            'regionsCount',
            'districtsCount',
            'categoriesCount',
            'productsCount',
            'purchasingPriceSum',
            'sellingPriceSum',
            'statusCount',
            'statusSum',
            'expiringTodayOrLaterCount',
            'expiringTodayOrLaterSum',
            'sellingPriceTrend',
            'categoryFrequency'
        ));
    }
}
