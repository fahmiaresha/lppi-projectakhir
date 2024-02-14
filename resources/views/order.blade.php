@extends('layouts.template')
@section('title','Order')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Datatable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">
@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
    <div>
        <h3>Pesanan</h3>
        <nav aria-label="breadcrumb" class="d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <form id="submit_pos" method="post" action="{{ url('/order') }}">
                @csrf
                <div class="coba mb-2">
                    <label for="date">
                        <font size="4"><strong>Invoice #<span class="text_nota"></span></strong> </font>
                    </label>
                    <input type="hidden" name="nota_id" id="value_nota" value="">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nota_date">Tanggal</label>
                        <input type="text" class="form-control @error('nota_date') is-invalid @enderror" id="nota_date" name="tanggal_penjualan" value="@php date_default_timezone_set('Asia/Jakarta'); echo date('d-m-Y H:i:s'); @endphp" readonly>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="kasir">Kasir</label>
                        <input type="text" class="form-control @error('nota_date') is-invalid @enderror" id="" placeholder="" name="nama_kasir" value="{{ auth()->user()->name }}" readonly>
                        <input type="hidden" name="id_kasir" value="{{ auth()->user()->id }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" onclick="show_alert()">
                            <i class="fa fa-plus-circle mr-2"></i>Pesanan</button>
                    </div>
                </div>
                <!-- .modal-lg -->
                <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="tambahModal">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Pesanan</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="ti-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered mydatatable table-hover" id="tabelproduk">
                                        <thead>
                                            <tr>
                                                <th width=1px scope="col">#</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Berat</th>
                                                <th scope="col">Deskripsi</th>
                                                <th scope="col">Gambar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product as $product)
                                            <tr id="row{{$product -> product_id}}" style="cursor:pointer;">
                                                <th scope="row">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="pr{{$product -> product_id}}">
                                                        <label class="custom-control-label" for="pr{{$product -> product_id}}"></label>
                                                    </div>
                                                </th>
                                                <td>{{ $product->name }}</td>
                                                <td> @foreach($categories as $category)
                                                    @if($product->category_id == $category->category_id)
                                                    {{ $category->name }}
                                                    @break
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>Rp. {{ number_format($product->price) }}</td>
                                                <td>{{ $product->weight }} Gr</td>
                                                <td>
                                                    {{ substr($product->description, 0, 50) }} {{ strlen($product->description) > 50 ? "..." : "" }}
                                                </td>
                                                <td>
                                                    {{ substr($product->img_url, 0, 20) }} {{ strlen($product->img_url) > 20 ? "..." : "" }}
                                                    <a href="{{ $product->img_url }}" target="_blank" class="font-weight-bold">View Image</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                </button>
                                <button type="button" class="btn btn-primary" id="save">Insert</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-2" id="tabel_cart">
                    <div id="keranjang_kosong">
                        <center>
                            <h5 style="color:#e3bcba">Keranjang Kosong , Silahkan Tambahkan Produk...</h5>
                            <br>
                        </center>
                    </div>
                </div>
                <div class="form-row">
                </div>
                <div class="form-group col-md-4">
                </div>
                <div class="form-group col-md-4">
                </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="exampleFormControlTextarea1"><strong>Total Bayar</strong></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Rp. </div>
                    </div>
                    <input type="hidden" name="subtotal" id="subtotal">
                    <input type="text" class="form-control readonly reset" id="subtotal-val" placeholder="Harga Keseluruhan" required>
                </div>
            </div>

            <div class="form-group col-md-1">
            </div>

            <div class="form-group col-md-3">
                <div class="form-row">
                    <label for="exampleFormControlTextarea1"> <strong>Cash</strong></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp. </div>
                        </div>
                        <input type="text" name="cash" class="form-control reset" id="cash" placeholder="Cash Pelanggan..." required>
                    </div>
                    <label for="exampleFormControlTextarea1" class="mt-3"> <strong>Change </strong></label>
                    <div class="input-group mt">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp. </div>
                        </div>
                        <input type="hidden" name="change" id="change">
                        <input class="form-control readonly reset" id="change-val" placeholder="Change" required>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-1">
            </div>

            <div class="form-group col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"><strong>Catatan</strong></label>
                    <textarea class="form-control reset" name="catatan_penjualan" id="exampleFormControlTextarea1" rows="3" placeholder="Catatan...."></textarea>
                </div>
            </div>
            <input type="hidden" class="coba" name="isi_kategori_pelanggan" id="isi_kategori_pelanggan">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button" onclick="klik_reset()" class="btn btn-danger mr-1">Reset</button>
                        <button type="submit" onclick="event.preventDefault();submit_transaksi();" class="btn btn-warning">Simpan Transaksi</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('script')

<script>
    var total_penjualan;
    var harga_produk_penjualan;
    var pilih_kategori_pelanggan;
    var pelanggan_kategori;
    var cash_uang;

    $(".readonly").keydown(function(e) {
        e.preventDefault();
    });

    $(document).ready(function() {
        $('.mydatatable').DataTable({
            "order": [
                [2, "asc"]
            ]
        });
        generateInvoiceId();
    });
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>


<script>
    function generateInvoiceId() {
        
        var currentDate = new Date();
        var year = currentDate.getFullYear().toString(); 
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); 
        var day = ('0' + currentDate.getDate()).slice(-2); 

        var dateFormatted = year + month + day;

        var orderCount = <?php echo $orderCount; ?>;

        var invoiceId = dateFormatted + '-' + ('000' + orderCount).slice(-3);
        $('.text_nota').html(invoiceId);
        $('#value_nota').val(invoiceId);
    }

    var angka = 0;
    jQuery(function($) {
        $("#save").click(function() {
            if (angka == 0) {
                var tambah_tabel = '\<table class="table table-bordered table-hover table-active" id="cart"></font>\
                                  <thead>\
                                  <tr>\
                                  <th style="font-weight:bold; text-align:center;">Nama Produk</th>\
                                    <th style="font-weight:bold; text-align:center;">Jumlah</th>\
                                    <th style="font-weight:bold; text-align:center;">Harga</th>\
                                    <th style="font-weight:bold; text-align:center;">Total Harga</th>\
                                    <th style="font-weight:bold; text-align:center;">Aksi</th>\
                                  </tr>\
                                </thead>\
                                    <tbody>\
                                    </tbody>\
                                </table>';
                $("#keranjang_kosong").hide();
                $("#tabel_cart").append(tambah_tabel);
                angka = 1;
            }
            var checks = $("#tambahModal").find("input[type=checkbox]:checked");
            var ids = Array();
            for (var i = 0; i < checks.length; i++) {
                ids[i] = checks[i].id;
                $("#" + ids[i]).prop("checked", false);
                ids[i] = ids[i].substring(2, 10); //PR001
                // console.log(ids[i]);
                if ($("#cart tbody tr#" + ids[i]).length) {
                    // console.log('masuk ifff');
                    $('#jumlah' + ids[i]).val(parseInt($('#jumlah' + ids[i]).val()) + 1);
                    recount(ids[i]);
                } else {
                    addRow(ids[i]);
                }
                // $("#tabelproduk tbody tr#row"+ids[i]).hide();
            }
        });

        // function agar di klik row mana saja bsa ke ceklis
        $('#tabelproduk tr').click(function() {
            var check = $(this).find("input[type=checkbox]");
            if (check.prop("checked") == true) {
                check.prop("checked", false);
            } else {
                check.prop("checked", true);
            }
        });
    });

    function klik_reset() {
        $("#cart").remove();
        angka = 0;
        $('.reset').val('');
        $("#keranjang_kosong").show();
        $('#pelanggan_kategori').attr('disabled', false);
    }


    var products = <?php echo json_encode($products); ?>;
    // console.log(products);
    function getIndex(id) {
        for (var i = 0; i < products.length; i++) {
            if (products[i]["product_id"] == id) {
                var index = i;
                // console.log('function getIndex');
                // console.log(index);
                return index;
            }
        }
    }

    function addRow(id) {
        var index = getIndex(id);
        // console.log('tampil index');
        // console.log(index);
        var id = products[index]["product_id"];
        var name = products[index]["name"];
        var price = products[index]["price"];
        var stock = products[index]["qty"];
        var mprice = money(price);
        var markup = "\
      <tr id='" + id + "' style='border: 1px;'>\
	  \
	  <td style='text-align: left; padding-left: 40px;' class='align-middle'>\
	    <div class='row'>\
	      <h6 class='name'>" + name + "</div>\
          <input type='hidden' name='name[" + id + "]' value=" + name + " readonly id='name" + id + "'></div>\
	    <div class='row'>\
	      <input type='hidden' name='product_id[" + id + "]' value=" + id + " readonly id='product_id" + id + "'></div>\
	  </td>\
	  \
	  <td style='width: 15%;' class='align-middle'>\
	    <div class='row justify-content-center'>\
      <button class='dec btn btn-sm btn-dark' type='button' onclick='dec(\"" + id + "\")'>-</button>\
	    	<input type='number' style='background-color:#808080; -moz-appearance: textfield; width: 30%; border:1px;text-align: center;' class='quantity' oninput='recount(\"" + id + "\")' name='jumlah[" + id + "]' min='1' id='jumlah" + id + "'required max='" + stock + "' value='1'>\
        <button class='inc btn btn-sm btn-dark' type='button' onclick='inc(\"" + id + "\")'>+</button>\
	    </div>\
	  </td>\
	  \
	  <td style='text-align: right; width:20%;' class='align-middle'>\
	    <div class='row justify-content-center'>\
	      <input type='hidden'  class='selling_price' name='selling_price[" + id + "]' id='price" + id + "' value='" + price + "'>\
	       Rp. " + "  " + mprice + "\
	  </div>\
    </td>\
	  \
	  <td class='align-middle' style='width: 25%;'>\
		  <div class='row align-middle justify-content-end'>\
		  	<input type='hidden' class='total' name='total[" + id + "]' min='1' id='total" + id + "' required>\
		  	<div class='col-4 pl-4'>\
		  		<h6 style='text-align: left;'>Rp.  </h6>\
		  	</div>\
		  	<div class='col-8' >\
	      		<h6 style='text-align: right; padding-right: 18px;' id='total-val" + id + "'></h6>\
	      	</div>\
		  </div>\
	  </td>\
	  \
	  <td style='width: 5%;' class='align-middle'>\
	  	<i class='btn btn-outline-danger' onclick='delRow(\"" + id + "\")' style='cursor: pointer; '>x</i>\
	  </td>\
	</tr>\
	";
        $("#cart tbody").append(markup);
        recount(id);
    }

    function money(text) {
        var text = text.toString();
        // console.log(text);
        var panjang = text.length; //4
        var hasil = new Array();
        if (panjang > 0) {
            if (panjang > 3) {
                var div = parseInt(panjang / 3); //1
                var char = new Array();
                var result = "";
                if (div > 1 && panjang > 6) {
                    var x = parseInt(panjang - (div * 3));
                    div++;
                    for (var i = 0; i < div; i++) {
                        if (i == 0) {
                            char[i] = text.slice(i, x);
                        } else {
                            char[i] = text.slice(((i - 1) * 3) + x, (i * 3) + x);
                        }
                        if (i == (div - 1)) {
                            hasil[i] = char[i];
                        } else {
                            hasil[i] = char[i] + ".";
                        }
                    }
                    for (var i = 0; i < div; i++) {
                        result += hasil[i];
                    }
                } else {
                    result = text.slice(0, panjang - 3) + "." + text.slice(panjang - 3, panjang);
                }
                return result;
            } else if (panjang > 0) {
                return text;
            }
            return 0;
        }
    }

    function recount(id) {
        // console.log("function recount");
        var jumlah = document.getElementById("jumlah" + id).value;
        var price = document.getElementById("price" + id).value;
        var subtotal = (jumlah * price);
        document.getElementById("total" + id).value = subtotal;
        percentDisc(id);
    };

    function delRow(id) {
        $('#cart tbody tr#' + id).remove();
        getTotal();
        $("#tabelproduk tbody tr#row" + id).show();
    }

    function percentDisc(id) {
        var total = document.getElementById("total" + id).value;
        document.getElementById("total" + id).value = total;
        document.getElementById("total-val" + id).innerHTML = money(total);
        getTotal();
    };

    function getTotal() {
        // console.log("function getTotal");
        var totals = document.getElementsByClassName("total");
        var i;
        var total_p = 0;
        for (i = 0; i < totals.length; ++i) {
            total_p = total_p + Number(totals[i].value);
        }
        document.getElementById('subtotal').value = total_p;
        document.getElementById('subtotal-val').innerHTML = money(total_p);
        document.getElementById('subtotal-val').value = money(total_p);
        total_penjualan = total_p;
        hitung_change();
    };

    function hitung_change() {
        var uang2 = document.getElementById('cash');
        uang2.addEventListener('keyup', function(e) {
            var uang = document.getElementById('cash').value;
            for (i = 0; i < 20; i++) {
                uang = uang.replace('.', '');
            }
            // console.log(uang);
            cash_uang = uang;
            document.getElementById('change').value = (uang - total_penjualan);
            document.getElementById('change-val').innerHTML = money((uang - total_penjualan));
            document.getElementById('change-val').value = money((uang - total_penjualan));
        });

        var uang = document.getElementById('cash').value;
        for (i = 0; i < 20; i++) {
            uang = uang.replace('.', '');
        }

        document.getElementById('change').value = (uang - total_penjualan);
        document.getElementById('change-val').innerHTML = money((uang - total_penjualan));
        document.getElementById('change-val').value = money((uang - total_penjualan));
    }

    var rupiah = document.getElementById('cash');
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value);
    });

    function inc(id) {
        var oldValue = $("#jumlah" + id).val(); //jumlahPR004
        // console.log('Nilai Old Value : ');
        // console.log(oldValue);
        var newVal = parseFloat(oldValue) + 1;
        // console.log('Nilai newVal : ');
        // console.log(newVal);
        var maximal = $("#jumlah" + id).attr('max');
        if (!(newVal > maximal)) {
            $("#jumlah" + id).val(newVal);
            recount(id);
        }
    }

    function dec(id) {
        var oldValue = $("#jumlah" + id).val();
        if (parseFloat(oldValue) > 1) {
            var newVal = parseFloat(oldValue) - 1;
            $("#jumlah" + id).val(newVal);
        }
        recount(id);
    }

    function show_alert() {
        $('#tambahModal').modal('show');
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function submit_transaksi() {
        let validate = document.getElementById('submit_pos').checkValidity();
        if (validate == false) {
            if (document.getElementById('cash').value == "") {
                show_alert_cash_kosong();
            } else {
                show_alert_melebihi_stok();
            }
            return false;
        } else {
            let total_bayar = document.getElementById('subtotal').value;
            // console.warn(cash_uang);
            // console.warn(total_bayar);
            if (parseInt(cash_uang) >= parseInt(total_bayar)) {
                document.getElementById("submit_pos").submit();
            } else {
                show_alert_gagal_bayar();
            }
        }
    }
</script>


<script>
    function show_alert_gagal_bayar() {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.error('Cash harus melebihi total bayar !');
    }

    function show_alert_cash_kosong() {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.error('Cash harus di inputkan !');
    }

    function show_alert_melebihi_stok() {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.error('Jumlah produk melebihi stok !');
    }
</script>

@if (session('insert'))
<script>
    swal("Success!", "Data Pesanan Berhasil Di Tambahkan", "success");
    $('#print_invoice').modal('show');
</script>
@endif

@if (session('gagal'))
<script>
    swal("Oops!", "Data Pesanan Gagal Di Tambahkan", "error");
</script>
@endif

@endsection