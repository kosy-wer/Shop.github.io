<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YourController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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


Route::get('/Product/{Product_Name}', function ($productName) {
    // Mengambil data produk berdasarkan nama atau kolom tertentu
    $product = Product::where('Product_Name', $productName)->first();

    // Mengirimkan data produk ke tampilan
    return view('tmp.shop-single', compact('product'));
});


Route::get('/get-products', [YourController::class, 'getProducts']);



Route::get('/Home', [ProductController::class, 'index'])->name('Home');

Route::get('/About', function () {
    return view('tmp.about');
})->name('About');



Route::get('/Shop', function () {
    return view('tmp.shop');
})->name('Shop');


Route::get('/Contact', function () {
    return view('tmp.contact');
})->name('Contact');

Route::get('/P', function () {
    return view('tmp.shop-single');
})->name('Product');

