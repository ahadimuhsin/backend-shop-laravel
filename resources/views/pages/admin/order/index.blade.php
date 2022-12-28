@extends('layouts.app', ['title' => 'Order'])

@section('content')
<div class="container-fluid mb-5">
    {{-- page heading --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-shopping-bag"> Orders</i>
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.orders.index') }}" method="get">
                        <div class="form-group">
                            <div class="input-group mb-3">

                                <input type="text" name="q" id="q" class="form-control"
                                    placeholder="Cari Berdasarkan Nomor Invoice">
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
                                    <th>No.Inovice</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="text-align: center; width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $no => $item)
                                <tr>
                                    <th scope="row" class="text-center">
                                        {{ ++$no + ($invoices->currentPage()-1) * $invoices->perPage() }}
                                    </th>
                                    <td>{{ $item->invoice }}</td>
                                    <td>{{ $invoice->name }}</td>
                                    <td class="text-center">{{ $invoice->status }}</td>
                                    <td>{{ moneyFormat($invoice->grand_total) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.show', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa fa-list-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6"
                                        style="background: rgb(233, 182, 182); color: black">Data Belum Ada</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-5">
                            Menampilkan {{ $invoices->count() }} data dari {{ $invoices->total() }} data
                            <div class="d-flex justify-content-center ">
                                {{ $invoices->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
