<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\InputProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->latest()->when(request()->q, function($products){
            $products = $products->where('title', 'like', '%'.request()->q.'%');
        })->paginate(10);

        return view('pages.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('pages.admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InputProductRequest $request)
    {
        $validated = $request->validated();

        //upload gambar
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        //save to DB
        $product = Product::create([
            'image' => $image->hashName(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'category_id' => $validated['category_id'],
            'content' => $validated['content'],
            'weight' => $validated['weight'],
            'price' => $validated['price'],
            'discount' => $validated['discount'],
        ]);

        if($product)
        {
            return redirect()->route('admin.products.index')->with('success', 'Data Berhasil Disimpan');
        }
        else{
            return redirect()->route('admin.products.index')->with('error', 'Data Gagal Disimpan');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('pages.admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product = Product::findOrFail($product->id);

        if($request->file('image') == '')
        {
            $product->update([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'category_id' => $validated['category_id'],
                'content' => $validated['content'],
                'weight' => $validated['weight'],
                'price' => $validated['price'],
                'discount' => $validated['discount'],
            ]);
        }
        else {
            Storage::disk('local')->delete('public/products/'.$product->image);

            //upload gambar
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            //update dengan image
            $product->update([
                'image' => $image->hashName(),
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'category_id' => $validated['category_id'],
                'content' => $validated['content'],
                'weight' => $validated['weight'],
                'price' => $validated['price'],
                'discount' => $validated['discount'],
            ]);
        }

        if($product)
        {
            return redirect()->route('admin.products.index')->with('success', 'Data Berhasil Diperbarui');
        }
        else{
            return redirect()->route('admin.products.index')->with('error', 'Data Gagal Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::disk('local')->delete('public/products/'.$product->image);
        $product->delete();

        if($product){
            return response()->json([
                'status' => 'success'
            ]);
        }
        else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
