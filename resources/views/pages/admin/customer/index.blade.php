@extends('layouts.app', ['title' => 'List Customers'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="h-0 font-weight-bold">
                        <i class="fas fa-users"></i> Customers
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.customer.index') }}" method="get">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" name="q" id="q" class="form-control"
                                placeholder="Cari Berdasarkan Nama Customer">
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
                                    <th scope="cols" class="text-center">
                                        No.
                                    </th>
                                    <th>Nama Customer</th>
                                    <th>Email</th>
                                    <th>Bergabung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $no => $item)
                                <tr>
                                    <th class="text-center" scope="row">
                                        {{ ++$no + ($customers->currentPage()-1) * $customers->perPage() }}
                                    </th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ tanggalIndonesia($item->created_at) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center"
                                    style="background: rgb(233, 182, 182); color: black">Data Belum Ada</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-5">
                            Menampilkan {{ $customers->count() }} data dari {{ $customers->total() }} data
                            <div class="d-flex justify-content-center ">
                                {{ $customers->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
