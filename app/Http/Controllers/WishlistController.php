<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function addToWishlist($product_id)
    {
        // Mendapatkan user yang terotentikasi
        $user_id = Auth::ID();

        // Pemeriksaan apakah kombinasi product_id dan user_id sudah ada
        $existingWishlistItem = Wishlist::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingWishlistItem) {
            // Jika sudah ada, beri respon sesuai kebutuhan Anda
            return response()->json(['message' => 'Product already in wishlist']);
        }

        // Jika belum ada, simpan ke dalam Wishlist dengan mencantumkan nilai 'created_at'
        Wishlist::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'created_at' => Carbon::now(),
            // tambahkan kolom lainnya sesuai kebutuhan
        ]);

        return response()->json(['message' => 'Product added to wishlist successfully']);
    }
}

