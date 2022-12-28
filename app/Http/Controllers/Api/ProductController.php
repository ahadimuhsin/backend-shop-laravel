<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Produk',
            'products' => $products
        ], 200);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if(!$product)
        {
            return response()->json([
                'success' => false,
                'message' => 'Data Produk Tidak Ditemukan',
                ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Produk',
            'product' => $product
        ], 200);
    }
}
