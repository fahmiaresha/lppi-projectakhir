@extends('layouts.template')
@section('title', 'Laporan Pesanan')
@section('head')
<!-- Datatable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<!-- select2 -->
<link rel="stylesheet" href="{{ url('vendors/select2/css/select2.min.css') }}" type="text/css">
<!-- rangepicker -->
<link rel="stylesheet" href="vendors/datepicker/daterangepicker.css" type="text/css">
@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
    <div>
        <h3>Laporan</h3>
        <nav aria-label="breadcrumb" class="d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Pesanan</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('laporan.filter') }}" method="GET" class="d-flex justify-content-end align-items-center" style="margin-top:-30px;">
            <div class="form-group mr-2">
                <input type="text" name="daterangepicker" class="demo-code-preview form-control" placeholder="Tanggal Nota" id="daterangepicker" value="{{ $startDate && $endDate ? Carbon\Carbon::createFromFormat('Y-m-d', $startDate)->format('d-m-Y') . ' - ' . Carbon\Carbon::createFromFormat('Y-m-d', $endDate)->format('d-m-Y') : '' }}">
            </div>
            <button type="submit" class="btn btn-primary mr-2 mt-3">Filter</button>
        </form>

        <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice ID</th>
                        <th>Kasir</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->invoice_id }}</td>
                        <td> @foreach($user as $s)
                            @if($order->user_id == $s->id)
                            {{ $s->name }}
                            @break
                            @endif
                            @endforeach
                        </td>
                        <td>Rp. {{ number_format($order->order_total) }}</td>
                        <td>
                            @if($order->order_status == 'on_progress')
                            <span class="badge bg-success-bright text-success">{{ $order->order_status }}</span>
                            @else
                            <span class="badge bg-info-bright text-info">{{ $order->order_status }}</span>
                            @endif
                        </td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-info mb-1 ml-2" data-toggle="modal" data-target="#modaldetail{{$order->order_id}}">
                                <i class="fa fa-info-circle mr-1"></i>Detail Pesanan
                            </button>

                            <div class="modal fade" id="modaldetail{{$order->order_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="ti-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1"><strong>No. Invoice</strong></label>
                                                        <div class="coba">
                                                            {{$order->invoice_id}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1"><strong>Tanggal</strong></label>
                                                        <div class="coba">
                                                            {{date('d-m-Y', strtotime($order->order_date)) }}
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1"><strong>Kasir</strong></label>
                                                        <div class="coba">
                                                            @foreach($user as $u)
                                                            @if($u->id== $order->user_id)
                                                            {{$u->name}}
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <label for="exampleFormControlTextarea1"><strong>Daftar Pembelian</strong></label>
                                            <div class="table-responsive mt-2">
                                                <table class="table table-active table-hover">
                                                    <thead>
                                                        <tr>
                                                            <center>
                                                                <th>#</th>
                                                                <th>Nama</th>
                                                                <th>Harga</th>
                                                                <th>Jumlah</th>
                                                                <th>Total</th>
                                                            </center>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $total = 0; $counter = 1;  @endphp
                                                        @foreach($order_item as $item)
                                                        @if($item->order_id == $order->order_id)
                                                        <tr>
                                                            <td>{{ $counter++ }}</td>
                                                            <td>{{ $item->product_name }}</td>
                                                            <td>Rp. {{ number_format($item->product_price) }}</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td>Rp. {{ number_format($item->subtotal) }}</td>
                                                        </tr>
                                                        @php $total += $item->subtotal; @endphp
                                                        @endif
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                                            <td>Rp. {{ number_format($total) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="vendors/datepicker/daterangepicker.js"></script>
<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

<script>
    $(document).ready(function() {
        // $('#myTable').DataTable();
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        });
        $('.select2-example').select2();
        $('input[name="daterangepicker"]').daterangepicker({
            opens: 'left',
            locale: {
                format: 'DD-MM-YYYY'
            },
        });
    });
</script>



@endsection