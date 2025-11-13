<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Models\Food;
// use App\Http\Controllers\QrController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $foods = Food::latest()->take(20)->get();
    return view('welcome', compact('foods'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('foods', FoodController::class);
});

    // Food CRUD routes
    // Food routes
    Route::get('/foods', [FoodController::class, 'index'])->name('foods.index'); // List all foods
    Route::get('/foods/create', [FoodController::class, 'create'])->name('foods.create'); // Show create form
    Route::post('/foods/store', [FoodController::class, 'store'])->name('foods.store'); // Store new food
    Route::get('/foods/{id}/edit', [FoodController::class, 'edit'])->name('foods.edit'); // Edit form
    Route::post('/foods/{id}/update', [FoodController::class, 'update'])->name('foods.update');
    Route::delete('/foods/{id}/delete', [FoodController::class, 'destroy'])->name('foods.delete'); // Delete food



    // Category Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); // List all categories
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create'); // Show create form
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store'); // Store new category
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); // Edit form
Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update'); // Update category
Route::delete('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Public user-facing category page
// Route::get('/browse-categories', [App\Http\Controllers\FoodController::class, 'browseCategories'])->name('browse.categories');

Route::get('/browse-categories', [FoodController::class, 'browseCategories'])->name('categories');
Route::get('/categories/{id}', [FoodController::class, 'showCategory'])->name('categories.show');

// Route::get('/', [QrController::class, 'showQr']);        // root shows QR
// Route::get('/welcome', [QrController::class, 'welcome'])->name('welcome'); // actual welcome page

Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');

// Route::get('/cart', function () {
//     $cart = session('cart', []);
//     return view('cart', compact('cart'));
// })->name('cart.page');

Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


Route::post('/complete-order', [OrderController::class, 'complete'])->name('order.complete');


// // Admin view all orders
Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');

// Update order status
Route::patch('admin/orders/{order}', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');


require __DIR__.'/auth.php';
