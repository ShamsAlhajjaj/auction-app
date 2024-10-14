<?php

// use App\Http\Controllers\BidController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// Route::get('/products', [ProductController::class, 'index'])->name('index');
// Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
// Route::get('/products/create', function () { return view('products.store');})->name('products.create');
// Route::post('/bids/store', [BidController::class, 'store'])->name('bids.store');
// Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.details');
// Route::get('/myProducts', [ProductController::class, 'myProducts'])->name('myProducts');
// Route::delete('/bids/{id}', [BidController::class, 'destroy'])->name('bids.destroy');



// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';



use App\Http\Controllers\BidController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('index');
Route::get('/products/create', function () { 
    return view('products.store');
})->name('products.create');
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.details');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');



// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Product Routes for Authenticated Users
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/myProducts', [ProductController::class, 'myProducts'])->name('myProducts');

    // Bid Routes for Authenticated Users
    Route::post('/bids/store', [BidController::class, 'store'])->name('bids.store');
    Route::delete('/bids/{id}', [BidController::class, 'destroy'])->name('bids.destroy');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes
require __DIR__.'/auth.php';
