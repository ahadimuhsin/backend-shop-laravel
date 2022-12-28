<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        // dd($this->category->id);
        return [
            'image' => Request::isMethod('post') ? 'required' : 'nullable'.'|image|mimes:png,jpg,jpeg|max:5000',
            'name' => 'required|unique:categories,name,'.$this->category->id
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Foto harus dilampirkan',
            'image.image' => 'File harus berbentuk gambar',
            'image.mimes' => 'File harus berkestensi jpg atau png',
            'image.max' => 'Ukuran maksimal file adalah 5MB',
            'name.required' => 'Nama Kategori harus diisi',
            'name.unique' => 'Nama Kategori harus unik'
        ];
    }
}
