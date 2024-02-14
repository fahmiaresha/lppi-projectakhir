@extends('layouts.template')
@section('title',' Category')
@section('head')
<!-- Datatable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

@endsection

@section('content')

<div class="page-header d-md-flex justify-content-between">
    <div>
        <h3>Kategori Produk</h3>
        <nav aria-label="breadcrumb" class="d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Kategori Produk</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#coba">
                <i class="fa fa-plus-circle mr-2"></i> Kategori Produk</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="{{ url('/category') }}">
                            <div class="modal-header">
                                <h5 class="modal-title">Data Kategori Produk</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <label for="Nama" style="margin-top:10px;">Nama Kategori</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" id="kategori_pelanggan" placeholder="Nama Kategori Produk" name="nama_kategori_produk" value="{{ old('kategori_produk') }}" required>
                                </div>
                                <label for="Kategori" style="margin-top:10px;">Kategori</label>
                                <select name="parent_id" class="select2-example">
                                    <option value="">Tidak Ada Kategori</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}">
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Insert</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- tutup modal -->
            <table id="myTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kategori Produk</th>
                        <th>Parent</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $c)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$c->name}}</td>
                        <td>
                            @php
                            $found = false;
                            @endphp

                            @foreach($categories as $category)
                            @if($c->parent_id == $category->category_id)
                            {{ $category->name }}
                            @php
                            $found = true;
                            break;
                            @endphp
                            @endif
                            @endforeach

                            @if (!$found)
                            -
                            @endif
                        </td>
                        <td>
                            <!-- Button trigger modal edit -->
                            <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{$c->category_id}}">
                                <i class="far fa-edit mr-1"></i>Edit
                            </button>
                            <div class="modal fade" id="editModal{{$c->category_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Kategori Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="{{ url('/category/'.$c->category_id) }}">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="id" value="{{$c->category_id}}">

                                                <label for="Nama" style="margin-top:10px;">Kategori Produk</label>
                                                <div class="form-group">
                                                    <input type="text" class="demo-code-preview form-control mt-1" id="kategori_produk" placeholder="Nama Kategori Pelanggan" name="kategori_produk" value="{{$c->name}}" required>
                                                </div>

                                                <label for="Kategori" style="margin-top:10px;">Kategori</label>
                                                <select name="edit_parent_id" class="form-control">
                                                    <option value="">Tidak Ada Kategori</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->category_id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" data-target="#delete1123{{$c->category_id}}">
                                <i class="fas fa-trash-restore mr-1"></i>Hapus</button>
                            <!-- Modal -->
                            <div class="modal fade" id="delete1123{{$c->category_id}}" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus kategori "{{ $c->name }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                            <form action="/category/{{ $c->category_id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary">
                                                    <font size="3" color="white">Yes</font>
                                                </button>
                                            </form>
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

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('.select2-example').select2();
        $('#select2-example').select2();
    });

    function tampil_cant_delete() {
        swal("Oops!", "Data Kategori Sedang Digunakan", "error");
    }
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
    swal("Success!", "Data Kategori Produk Berhasil Di Tambahkan", "success");
</script>
@endif

@if (session('update'))
<script>
    swal("Success!", "Data Kategori Produk Berhasil Di Update", "success");
</script>
@endif

@if (session('delete'))
<script>
    swal("Success!", "Data Kategori Produk Berhasil Di Hapus", "success");
</script>
@endif
@endsection