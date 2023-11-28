<?php

use App\Http\Controllers\ProfileController;
use App\Models\product;
use App\Http\Controllers\homepageController;
use Illuminate\Support\Facades\Route;
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
});

Route::controller(homepageController::class)->group(function () {
    Route::get('/homepages', 'index')->middleware(['auth', 'verified'])->name('homepages');
});

Route::controller(sellerRegisterController::class)->group(function () {
    Route::get('/registerSeller/shopRegister', 'index')->middleware('auth')->name('shopRegisterview');
    Route::post('/registerSeller/shopRegister', 'makeShop')->middleware('auth')->name('shopRegister');
});

Route::controller(sellerDashboardController::class)->group(function () {
    Route::get('/sellerDashboard', 'index')->middleware('seller')->name('sellerDashboard');
    Route::get('/sellerDashboard/addProduct', 'create')->middleware('seller')->name('addProduct');
    Route::post('/sellerDashboard/addProduct', 'store')->middleware('seller')->name('addProduct');
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

require __DIR__ . '/auth.php';
