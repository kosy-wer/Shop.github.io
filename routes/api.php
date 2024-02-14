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
    $products = $request->input('products');

    // Initialize Twilio client
    $sid    = "ACd4fc4b9fbf52cd8223c9d32957770f11";
    $token  = "da51fe9a980b12e20471bcf7449dd578";
    $twilio = new Client($sid, $token);

    $messages = [];

    foreach ($products as $product) {
        $productName = $product['product_name'];
        $quantity = $product['quantity'];

        // Retrieve product information from the database
        $productData = Product::where('Product_Name', $productName)->first();
        $productName = $productData->Product_Name;

        // Create message for each product
        $messages[] = "Nama Produk: $productName\nJumlah Barang: $quantity";
    }

    // Combine all messages into one
    $combinedMessage = implode("\n\n", $messages);

    // Send WhatsApp message
    $message = $twilio->messages
        ->create("whatsapp:+6285648403583", // to
            [
                "from" => "whatsapp:+14155238886",
                "body" => $combinedMessage,
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
