@extends('layouts.app', ['title' => 'Kategori'])

@section('content')
<div class="container-fluid mb-5">
    {{-- page heading --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-folder"> Kategori</i>
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.categories.index') }}" method="get">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm"
                                        style="padding-top: 10px">
                                        <i class="fas fa-plus-circle"></i> Tambah
                                    </a>
                                </div>
                                <input type="text" name="q" id="q" class="form-control"
                                    placeholder="Cari Berdasarkan Nama Kategori">
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
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col" style="text-align: center; width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $no => $item)
                                <tr>
                                    <th scope="row" class="text-center">
                                        {{ ++$no + ($categories->currentPage()-1) * $categories->perPage() }}
                                    </th>
                                    <td class="text-center">
                                        <img src="{{ $item->image }}" style="width: 100px">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.categories.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button onclick="deleteCategories(this.id)" class="btn btn-sm btn-danger" id="{{ $item->id }}">
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
                            Menampilkan {{ $categories->count() }} data dari {{ $categories->total() }} data
                            <div class="d-flex justify-content-center ">
                                {{ $categories->appends(request()->input())->links() }}
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
    function deleteCategories(id)
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
                    url: "{{ route('admin.categories.index') }}/" + id,
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
