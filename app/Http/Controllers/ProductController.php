<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Mengambil semua data dari tabel 'Product'

        return view('tmp.index', compact('products')); // Meneruskan data ke view
    }
}

