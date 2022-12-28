<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List Kategori',
            'data' => $categories
        ]);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if(!$category)
        {
            return response()->json([
                'success' => false,
                'message' => 'Data Produk Berdasarkan Kategori Tidak Ditemukan',
                ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Produk Berdasarkan Kategori: ' .$category->name,
            'product' => $category->products()->latest()->get()
        ], 200);
    }

    public function categoryHeader()
    {
        $categories = Category::latest()->take(5)->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Kategori Header',
            'categories' => $categories
        ]);
    }
}
