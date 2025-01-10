<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    // Product routes
    Route::resource('products', ProductController::class);
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/export-csv', [ProductController::class, 'exportCsv'])->name('products.export');
    Route::get('/filters', [ProductController::class, 'getFilters'])->name('products.filters');

    // Category, Region, and District routes
    Route::resource('categories', CategoryController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('districts', DistrictController::class);

    //department
    Route::resource('departments', DepartmentController::class);

    //roles
    Route::resource('roles', RoleController::class);

    // Analytics route
    Route::get('', [AnalyticsController::class, 'index'])->name('analytics.index');

    //Register Users
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    //view  and change user profile
    Route::middleware('auth')->get('/profile/edit', [ProfileController::class, 'show'])->name('profile.edit');
    Route::middleware('auth')->post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    //user management, create view update and delete
    Route::delete('/users/{user}', [AuthController::class, 'destroy'])->name('user.destroy');
    Route::get('user/edit/{id}', [AuthController::class, 'editUser'])->name('user.edit');
    Route::put('user/update/{id}', [AuthController::class, 'updateUser'])->name('user.update');
    Route::get('/users/{user}', [AuthController::class, 'show'])->name('user.show');


});

//(accessible for unauthenticated users)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



 





 