@extends('layouts.app', ['title' => 'Edit Produk'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-folder"> Edit Produk {{ $product->name }}</i>
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Nama Kategori" value="{{ old('title', $product->title) }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="category_id" id="category_id" class="form-control @error('category_id')
                                    is-invalid
                                    @enderror">
                                        <option value="">-- PILIH KATEGORI --</option>
                                        @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ $product->category_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Berat (gram)</label>
                                <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror"
                                placeholder="Berat Produk (gram)" value="{{ old('weight', $product->weight) }}">
                                @error('weight')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Deskripsi</label>
                            <textarea name="content" class="form-control content @error('content')
                            is-invalid
                            @enderror" rows="6">{{ old('content', $product->content) }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                                    placeholder="Harga Produk (Rp)" value="{{ old('price', $product->price) }}">
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror"
                                    placeholder="Diskon Produk (%)" value="{{ old('discount', $product->discount) }}">
                                    @error('discount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button class="btn btn-primary mr-1 btn-submit" type="submit">
                            <i class="fa fa-paper-plane"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-warning btn-reset"><i class="fa fa-redo"></i> Reset</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.content'
      });
</script>
@endpush
