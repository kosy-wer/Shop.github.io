<?php 

// app/Http/Controllers/WishlistController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        // Buat wishlist baru
        $wishlist = new Wishlist([
            'user_id' => auth()->id(), // Anda dapat mengganti ini dengan cara yang sesuai untuk mendapatkan user_id
            'product_id' => $request->input('product_id'),
        ]);

        // Simpan ke database
        $wishlist->save();

        // Beri respons sesuai kebutuhan (contoh respons JSON)
        return response()->json(['message' => 'Product added to wishlist successfully']);
    }
}

