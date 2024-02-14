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