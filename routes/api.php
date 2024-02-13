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

    Route::post('/buy/{msg}', function ($msg) {


$sid    = "ACd4fc4b9fbf52cd8223c9d32957770f11";
$token  = "d7d593080632eefd589dc6f941a64508";
$twilio = new Client($sid, $token);
$product = Product::where('Product_ID', $msg)->first();
$product_name = $product->Product_Name;

$message = $twilio->messages
    ->create("whatsapp:+6285648403583", // to

    	[
    "from" => "whatsapp:+14155238886",
    "body" => "Nama Produk: $product_name\nJumlah Barang: $msg"
]


    
    );

print($message->sid);

    
    
    
    });

    // Semua rute dalam grup ini akan menggunakan middleware 'auth:sanctum'
    Route::post('/add-to-wishlist/{product_name}', [WishlistController::class, 'addToWishlist']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
