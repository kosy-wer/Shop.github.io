<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;
use Twilio\Rest\Client;
use App\Models\Product;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/buy', function (Request $request) {
	    
$productName = $request->input('product_name');
$quantity = $request->input('quantity');
$sid    = "ACd4fc4b9fbf52cd8223c9d32957770f11";
$token  = "23676e9b749e519981a05bdf43ed9dad";
$twilio = new Client($sid, $token);
$product = Product::where('Product_Name', $productName)->first();
$product_name = $product->Product_Name;

$message = $twilio->messages
    ->create("whatsapp:+6285648403583", // to

    	[
    "from" => "whatsapp:+14155238886",
    "body" => "Nama Produk: $product_name\nJumlah Barang: $quantity"
]


    
    );

print($message->sid);

    
    
    
    });

    // Semua rute dalam grup ini akan menggunakan middleware 'auth:sanctum'
    Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
