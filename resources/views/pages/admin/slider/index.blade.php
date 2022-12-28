@extends('layouts.app', ['title' => 'Sliders'])

@section('content')
<div class="container-fluid mb-5">
    {{-- page heading --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-image"> Upload Slider</i>
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.sliders.store') }}" method="post"
                    enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" id="image"
                            class="form-control @error('image')
                                is-invalid
                            @enderror">
                            @error('image')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" name="link" id="link"
                            class="form-control @error('link')
                                is-invalid
                            @enderror" value="{{ old('link') }}">
                            @error('link')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit">
                            <i class="fa fa-paper-plane"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-warning btn-reset"><i class="fa fa-redo"></i> Reset</button>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow mt-3 mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-laptop"></i> Sliders
                    </h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No.</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Link</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sliders as $no => $item)
                                <tr>
                                    <th scope="row" class="text-center">
                                        {{ ++$no + ($sliders->currentPage()-1) * $sliders->perPage() }}
                                    </th>
                                    <td class="text-center">
                                        <img src="{{ $item->image }}" class="rounded" style="width: 200px">
                                    </td>
                                    <td>{{ $item->link }}</td>
                                    <td class="text-center">
                                        <button onclick="delete(this.id)" class="btn btn-sm btn-danger"
                                        id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
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
                            Menampilkan {{ $sliders->count() }} data dari {{ $sliders->total() }} data
                            <div class="d-flex justify-content-center ">
                                {{ $sliders->appends(request()->input())->links() }}
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
    function delete(id)
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
                    url: "{{ route('admin.sliders.index') }}/" + id,
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
