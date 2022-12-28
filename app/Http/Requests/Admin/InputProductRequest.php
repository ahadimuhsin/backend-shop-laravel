<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class InputProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => Request::isMethod('post') ? 'required' : 'nullable'.'|image|mimes:png,jpg,jpeg|max:5000',
            'title' => 'required|unique:products,title',
            'category_id' => 'required',
            'content' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'discount' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Gambar harus diisi',
            'image.image' => 'Gambar harus berupa file gambar',
            'image.mimes' => 'File gambar harus berekstensi png, jpg, atau jpeg',
            'image.max' => 'Ukuran maksimal file gambar 5MB',
            'title.required' => 'Nama produk harus diisi',
            'title.unique' => 'Nama produk harus unik',
            'category_id.required' => 'Kategori harus diisi',
            'content.required' => 'Konten harus diisi',
            'weight.required' => 'Berat produk harus diisi',
            'price.required' => 'Harga produk harus diisi',
            'discount.required' => 'Harga discount harus diisi'
        ];
    }
}
