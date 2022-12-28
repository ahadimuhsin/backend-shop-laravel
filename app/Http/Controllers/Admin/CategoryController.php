<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\InputCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->when(request()->q, function($categories){
            $categories = $categories->where('name', 'like', '%'.request()->q.'%');
        })->paginate(10);

        return view('pages.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InputCategoryRequest $request)
    {
        $data = $request->validated();
        // dd($request->all());
        $image = $request->file('image');
        $image->storeAs('public/categories', $image->hashName());

        //simpan ke DB
        $category = Category::create([
            'image' => $image->hashName(),
            'name' => $data['name'],
            'slug' => Str::slug($data['name'], '-')
        ]);

        if($category)
        {
            return redirect()->route('admin.categories.index')->with('success', 'Data Berhasil Disimpan');
        }
        else{
            return redirect()->route('admin.categories.index')->with('error', 'Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view('pages.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $data = $request->validated();

        if(!$request->file('image'))
        {
            //update tanpa image
            $category = Category::findOrFail($category->id);
            $category->update([
                'name' => $data['name'],
                'slug' => Str::slug($data['name'], '-')
            ]);
        }
        else {
            // hapus image lama
            $delete = Storage::disk('local')->delete('public/categories/'.$category->image);
            // unlink($category->image);
            // dd($category->image);
            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            //update dengan image baru
            $category = Category::findOrFail($category->id);
            $category->update([
                'image' => $image->hashName(),
                'name' => $data['name'],
                'slug' => Str::slug($data['name'], '-')
            ]);
        }

        if($category)
        {
            return redirect()->route('admin.categories.index')->with('success', 'Data Berhasil Diperbarui');
        }
        else{
            return redirect()->route('admin.categories.index')->with('error', 'Data Gagal Diperbarui');
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
        $category = Category::findOrFail($id);
        Storage::disk('local')->delete('public/categories/'.$category->image);
        $category->delete();

        if($category){
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
