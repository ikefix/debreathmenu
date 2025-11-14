<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Models\Food;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $foods = Food::latest()->take(20)->get();
    return view('welcome', compact('foods'));
});


// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authenticated food CRUD routes
Route::middleware(['auth'])->group(function () {
    Route::resource('foods', FoodController::class);
});

// Explicit Food CRUD routes (optional if you prefer explicit over resource)
Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');
Route::get('/foods/create', [FoodController::class, 'create'])->name('foods.create');
Route::post('/foods/store', [FoodController::class, 'store'])->name('foods.store');
Route::get('/foods/{id}/edit', [FoodController::class, 'edit'])->name('foods.edit');
Route::post('/foods/{id}/update', [FoodController::class, 'update'])->name('foods.update');
Route::delete('/foods/{id}/delete', [FoodController::class, 'destroy'])->name('foods.delete');

// Category management routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Public user-facing category pages
Route::get('/browse-categories', [FoodController::class, 'browseCategories'])->name('browse.categories'); // this fixes route('browse.categories')
Route::get('/categories/{id}', [FoodController::class, 'showCategory'])->name('categories.show');

// Cart routes
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Complete order
Route::post('/complete-order', [OrderController::class, 'complete'])->name('order.complete');

// Admin orders
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::patch('/admin/orders/{order}', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

require __DIR__.'/auth.php';
