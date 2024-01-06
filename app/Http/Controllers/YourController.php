<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class YourController extends Controller
{

public function yourFunction(Request $request) {
    return view('your_view');	
} 

public function getProducts(Request $request)
    {
        $products = Product::paginate(3); // Jumlah item per halaman: 10
        return response()->json($products);
    }
}
