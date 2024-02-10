<?php 

// app/Http/Controllers/WishlistController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
    public function addToWishlist($name_product )
    {
    

        $user_id = Auth::id();

        // Menyimpan data ke dalam Wishlist
        Wishlist::create([
            'user_id' => $user_id,
            'product_id' => $name_product, // Disesuaikan sesuai kebutuhan Anda
	    'created_at' => Carbon::now(), // Menggunakan Carbon untuk mendapatkan waktu saat ini
	]);

        return response()->json(['message' => 'Product added to wishlist successfully']);

    
    }
}

