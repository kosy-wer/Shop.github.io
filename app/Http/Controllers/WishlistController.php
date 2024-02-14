<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        // Mendapatkan user yang terotentikasi
	    $user_id = Auth::ID();
	    $productName = $request->input('product_name');
	    $quantity = $request->input('quantity');

        // Pemeriksaan apakah kombinasi product_id dan user_id sudah ada
        $existingWishlistItem = Wishlist::where('user_id', $user_id)
            ->where('product_name', $productName)
            ->first();

        if ($existingWishlistItem) {
		// Jika sudah ada, beri respon sesuai kebutuhan Anda
	if ($existingWishlistItem->quantity != $quantity) {
            // Update nilai quantity jika berbeda
            $existingWishlistItem->update(['quantity' => $quantity]);
            return response()->json(['message' => "Quantity updated for product ${productName}"]);
        }
	return response()->json(['message' => "Product already in wishlist ${productName}"]);

	}

        // Jika belum ada, simpan ke dalam Wishlist dengan mencantumkan nilai 'created_at'
        Wishlist::create([
            'user_id' => $user_id,
            'product_name' => $productName,
	    'created_at' => Carbon::now(),
	    'quantity' => $quantity,
            // tambahkan kolom lainnya sesuai kebutuhan
        ]);

        return response()->json(['message' => 'Product added to wishlist successfully']);
    }
}

