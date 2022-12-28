@extends('layouts.app', ['title' => 'Produk'])

@section('content')
<div class="container-fluid mb-5">
    {{-- page heading --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-shopping-bag"> Produk</i>
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.products.index') }}" method="get">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <a href="{{ route('admin.products.create') }}"
                                    class="btn btn-primary btn-sm"
                                        style="padding-top: 10px">
                                        <i class="fas fa-plus-circle"></i> Tambah
                                    </a>
                                </div>
                                <input type="text" name="q" id="q" class="form-control"
                                    placeholder="Cari Berdasarkan Nama Produk">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center; width: 6%">No</th>
                                    <th>Foto</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col" style="text-align: center; width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $no => $item)
                                <tr>
                                    <th scope="row" class="text-center">
                                        {{ ++$no + ($products->currentPage()-1) * $products->perPage() }}
                                    </th>
                                    <td><img src="{{ $item->image }}" style="width: 100px"></td>
                                    <td>
                                        {{ $item->title }}
                                    </td>
                                    <td>{{ $item->category->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.products.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button onclick="deleteProducts(this.id)" class="btn btn-sm btn-danger" id="{{ $item->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="4"
                                        style="background: rgb(233, 182, 182); color: black">Data Belum Ada</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-5">
                            Menampilkan {{ $products->count() }} data dari {{ $products->total() }} data
                            <div class="d-flex justify-content-center ">
                                {{ $products->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<script type="text/javascript">

    function myFunction()
    {
        alert('Tes');
    }
    function deleteProducts(id)
    {
        // let id = id;
        let token = $("meta[name='csrf-token']").attr("content");

        swal({
            title: "Apakah Kamu Yakin?",
            text: "Hapus Data",
            icon: "warning",
            buttons: [
                "TIDAK",
                "YA"
            ],
            dangerMode: true
        }).then(function(isConfirm){
            if(isConfirm){
                jQuery.ajax({
                    url: "{{ route('admin.products.index') }}/" + id,
                    data: {
                        "id" : id,
                        "_token": token
                    },
                    type: "DELETE",
                    success: function(response){
                        if(response.status == "success")
                        {
                            swal({
                                title: "Berhasil!",
                                text: "Data Berhasil Dihapus",
                                icon: "success",
                                timer: 1000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false,
                            }).then(function(){
                                location.reload();
                            });
                        }
                        else{
                            swal({
                                title: "Gagal!",
                                text: "Data Gagal Dihapus",
                                icon: "error",
                                timer: 1000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false,
                            }).then(function(){
                                location.reload();
                            });
                        }
                    }
                });
            }
            else
            {
                return true;
            }
        })
    }
</script>
@endpush
