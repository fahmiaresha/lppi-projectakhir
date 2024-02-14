@extends('layouts.template')
@section('title','Dashboard')
@section('content')
<div class="page-header d-md-flex justify-content-between">
    <div>
        <h3>Welcome back, {{ auth()->user()->name }}</h3>
        <p class="text-muted">Halaman ini menunjukkan ringkasan penjualan produk.</p>

    </div>
    <div class="mt-3 mt-md-0">
        <div class="btn btn-outline-light">
            <span>
                @php
                date_default_timezone_set('Asia/Jakarta');
                $hariIni = new DateTime();
                echo strftime('%A %d %B %Y, %H:%M', $hariIni->getTimestamp()) . '<br>';
                @endphp</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <a href="/data-produk">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">Rp. {{number_format($totalOmset)}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Omset</div>
                </div>
            </div>
        </a>
    </div>


    <div class="col-md-3">
        <a href="/kategori-produk">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$totalAdmin}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah User</div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="/service-pelanggan">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$totalCategories}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Kategori Produk</div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="/data-penjualan">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$totalProducts}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Produk</div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <a href="/data-produk">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">{{$newOrders}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Orderan Baru</div>
                </div>
            </div>
        </a>
    </div>


    <div class="col-md-3">
        <a href="/kategori-produk">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$processingOrders}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Order Diproses</div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="/service-pelanggan">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$shippedOrders}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Orderan Dikirim</div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="/data-penjualan">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$completedOrders}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Orderan Selesai</div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title mb-2">Jumlah Penjualan </h6>
                </div>
                <div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Hari</h5>
                                <div>Total penjualan</div>
                            </div>
                            <h3 class="text-warning mb-0">Rp. {{number_format($dailySales)}}</h3>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Bulan</h5>
                                <div>Total penjualan</div>
                            </div>
                            <div>
                                <h3 class="text-info mb-0">Rp. {{number_format($monthlySales)}}</h3>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Tahun</h5>
                                <div>Total penjualan</div>
                            </div>
                            <div>
                                <h3 class="text-success mb-0">Rp. {{number_format($yearlySales)}}</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title mb-2">Produk terjual</h6>
                </div>
                <div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Hari</h5>
                                <div>Total penjualan</div>
                            </div>
                            <h3 class="text-warning mb-0">{{$dailySoldProducts}}</h3>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Bulan</h5>
                                <div>Total penjualan</div>
                            </div>
                            <div>
                                <h3 class="text-info mb-0">{{$monthlySoldProducts}}</h3>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Tahun</h5>
                                <div>Total penjualan</div>
                            </div>
                            <div>
                                <h3 class="text-success mb-0">{{$yearlySoldProducts}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection