<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Models\product;
use App\Http\Controllers\homepageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\addProductController;
use App\Http\Controllers\Auth\sellerRegisterController;
use App\Http\Controllers\sellerDashboardController;

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

Route::controller(homepageController::class)->group(function () {
    Route::get('/', 'index')->name('homepage');
    Route::get('/homepage/detail/{product}', 'detail');
    Route::get('/homepages/addToCart/{productId}', 'addToCart')->middleware('auth', 'verified');
});

Route::controller(homepageController::class)->group(function () {
    Route::get('/homepages', 'index')->middleware(['auth', 'verified'])->name('homepages');
    Route::get('/homepages/detail/{product}', 'detail')->middleware(['auth', 'verified']);
    Route::get('/homepages/MyCart', 'cart')->middleware(['auth', 'verified']);
    Route::get('/homepages/addToCart/{productId}', 'addToCart')->middleware('auth', 'verified');
    Route::delete('/homepages/deleteCart/{productId}', 'deleteCart')->middleware('auth', 'verified');
    Route::get('/homepages/orderNow/{productId}', 'orderView')->middleware('auth', 'verified');
    Route::post('/homepages/orderNow/{productId}', 'orderNow')->middleware('auth', 'verified');
    Route::get('/homepages/MyOrder/', 'MyOrder')->middleware('auth', 'verified');
});

Route::controller(sellerRegisterController::class)->group(function () {
    Route::get('/registerSeller/shopRegister', 'index')->middleware('seller')->name('shopRegisterview');
    Route::post('/registerSeller/shopRegister', 'makeShop')->middleware('seller')->name('shopRegister');
});

Route::controller(sellerDashboardController::class)->group(function () {
    Route::get('/sellerDashboard', 'index')->middleware('seller')->name('sellerDashboard');
    Route::get('/sellerDashboard/MyOrderSeller', 'orderViewSeller')->middleware('seller')->name('orderViewSeller');
    Route::delete('/sellerDashboard/MyOrderSellerDelete/{id}', 'deleteOrder')->middleware('seller')->name('deleteOrder');
});


Route::controller(productController::class)->group(function () {
    Route::get('/sellerDashboard/addProduct', 'create')->middleware('seller')->name('addProduct');
    Route::post('/sellerDashboard/addProduct', 'store')->middleware('seller')->name('addProduct');
    Route::get('/sellerDashbord/MyProductSellerEdit/{id}', 'IndexeditProduct')->middleware('seller')->name('FormeditProduct');
    Route::post('/sellerDashbord/MyProductSellerEdit/{id}', 'editProduct')->middleware('seller')->name('editProduct');
    Route::delete('/sellerDashboard/MyProductSellerDelete/{id}', 'deleteProduct')->middleware('seller')->name('deleteProduct');
});

// Route::controller(addProductController::class)->group(function () {
//     Route::get('/addProduct', 'index');
//     Route::post('/addProduct', 'store');
// });



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('checkout/{productId}', [CartController::class, 'addToCart']);

require __DIR__ . '/auth.php';
