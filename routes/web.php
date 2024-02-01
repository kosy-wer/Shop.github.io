<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YourController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Models\Product;
use App\Models\Wishlist;
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

Route::middleware('auth')->group(function () {
Route::get('/Product/{Product_Name}', function ($productName) {
    // Mengambil data produk berdasarkan nama atau kolom tertentu
    $product = Product::where('Product_Name', $productName)->first();

    // Mengirimkan data produk ke tampilan
    return view('tmp.shop-single', compact('product'));
});

Route::get('/Cart', function () {

	$user_id = Auth::id(); // Mengambil user_id dari pengguna yang diotentikasi
        $wishlistData = Wishlist::where('user_id', $user_id)->get();

        // Mengambil semua data produk berdasarkan Product_ID dari tabel wishlists
        $productData = Product::whereIn('Product_ID', $wishlistData->pluck('product_id'))->get();

        return view('tmp.cart', ['wishlistData' => $wishlistData, 'user_id' => $user_id, 'productData' => $productData]);



})->name('Cart');


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

});

Route::post('/Register', [LoginController::class, 'authenticate']);
Route::get('/login', function () {
        return view('tmp.login');                                     })->name('login');
