@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
<div class="container-fluid">
    {{-- page heading --}}

    <div class="row">
        {{-- Area Chart --}}
        {{-- Month --}}
        <div class="col-md-4">
            <div class="card border-0 shadow mb-4">
                {{-- Card Header - Dropdown --}}
                <div class="card-header py-3 d-flex flex-row align-items-center
                justify-content-between">
                    <h6 class="m-0 font-weight-bold text-uppercase">
                        Pendapatan Bulan Ini
                    </h6>
                </div>
                <div class="card-body">
                    <h5>{{ moneyFormat($revenuePerMonth) }}</h5>
                </div>
            </div>
        </div>
        {{-- Year --}}
        <div class="col-md-4">
            <div class="card border-0 shadow mb-4">
                {{-- Card Header - Dropdown --}}
                <div class="card-header py-3 d-flex flex-row align-items-center
                justify-content-between">
                    <h6 class="m-0 font-weight-bold text-uppercase">
                        Pendapatan Tahun Ini
                    </h6>
                </div>
                <div class="card-body">
                    <h5>{{ moneyFormat($revenuePerYear) }}</h5>
                </div>
            </div>
        </div>
        {{-- All --}}
        <div class="col-md-4">
            <div class="card border-0 shadow mb-4">
                {{-- Card Header - Dropdown --}}
                <div class="card-header py-3 d-flex flex-row align-items-center
                justify-content-between">
                    <h6 class="m-0 font-weight-bold text-uppercase">
                        Semua Pendapatan
                    </h6>
                </div>
                <div class="card-body">
                    <h5>{{ moneyFormat($revenueAll) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Earnings Card Example --}}
        {{-- Pending --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary
                            text-uppercase mb-1">
                            Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pending }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-circle-notch fa-spin fa-2x" style="color: #4d72df">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- success --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary
                            text-uppercase mb-1">
                            success
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $success }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x" style="color: #2acf54">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- expired --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary
                            text-uppercase mb-1">
                            expired
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $expired }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x" style="color: #f6c23e">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- failed --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary
                            text-uppercase mb-1">
                            failed
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $failed }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x" style="color: #b41b10">
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
