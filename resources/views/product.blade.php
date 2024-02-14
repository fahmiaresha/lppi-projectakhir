@extends('layouts.template')
@section('title', 'Produk')
@section('head')
<!-- Datatable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<!-- select2 -->
<link rel="stylesheet" href="{{ url('vendors/select2/css/select2.min.css') }}" type="text/css">
@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
    <div>
        <h3>Produk</h3>
        <nav aria-label="breadcrumb" class="d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <!-- Tambahkan tombol untuk menambah produk -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahProduk">
                <i class="fa fa-plus-circle mr-2"></i> Tambah Produk</button>
            <!-- Modal Tambah Produk -->
            <!-- Modal Tambah Produk -->
            <div class="modal fade" tabindex="-1" role="dialog" id="tambahProduk">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/product') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Produk" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi Produk" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="draft">Draft</option>
                                        <option value="publish">Publish</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <!-- Tampilkan pilihan kategori dari database -->
                                        @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Harga Produk" required>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Berat</label>
                                    <input type="number" class="form-control" id="weight" name="weight" placeholder="Berat Produk (Gram)" required>
                                </div>
                                <div class="form-group">
                                    <label for="img_url">URL Gambar</label>
                                    <input type="text" class="form-control" id="img_url" name="img_url" placeholder="URL Gambar Produk" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <table id="myTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop untuk menampilkan data produk -->
                    @foreach($product as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            {{ substr($product->description, 0, 50) }} {{ strlen($product->description) > 50 ? "..." : "" }}
                            <a href="#" data-toggle="modal" data-target="#deskripsiProduk{{ $product->product_id }}" class="font-weight-bold">Read More</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="deskripsiProduk{{ $product->product_id }}">
                                <div class="modal-dialog modal-xl" role="document"> <!-- Tambahkan class modal-xl di sini -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Deskripsi Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $product->description }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td>
                            @if($product->status == 'Publish')
                            <span class="badge bg-success-bright text-success">{{ $product->status }}</span>
                            @else
                            <span class="badge bg-info-bright text-info">{{ $product->status }}</span>
                            @endif
                        </td>
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
                            {{ substr($product->img_url, 0, 20) }} {{ strlen($product->img_url) > 20 ? "..." : "" }}
                            <a href="{{ $product->img_url }}" target="_blank" class="font-weight-bold">View Image</a>
                        </td>
                        <td>
                            <!-- Tombol aksi (edit, hapus) -->
                            <!-- Modal Edit Produk -->
                            <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editProduk{{ $product->product_id }}">
                                <i class="far fa-edit mr-1"></i>Edit
                            </button>

                            <div class="modal fade" id="editProduk{{ $product->product_id }}" tabindex="-1" role="dialog" aria-labelledby="editProdukLabel{{ $product->product_id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProdukLabel{{ $product->product_id }}">Edit Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form untuk mengedit produk -->
                                            <form action="{{ url('/product/' . $product->product_id) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="edit_name{{ $product->product_id }}">Nama Produk</label>
                                                    <input type="text" class="form-control" id="edit_name{{ $product->product_id }}" name="name" value="{{ $product->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_description{{ $product->product_id }}">Deskripsi</label>
                                                    <textarea class="form-control" id="edit_description{{ $product->product_id }}" name="description" rows="3" required>{{ $product->description }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_status{{ $product->product_id }}">Status</label>
                                                    <select class="form-control" id="edit_status{{ $product->product_id }}" name="status" required>
                                                        <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                                        <option value="publish" {{ $product->status == 'publish' ? 'selected' : '' }}>Publish</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edit_category_id{{ $product->product_id }}">Kategori</label>
                                                    <select class="form-control" id="edit_category_id{{ $product->product_id }}" name="category_id" required>
                                                        <!-- Looping untuk menampilkan pilihan kategori dari database -->
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->category_id }}" {{ $product->category_id == $category->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_price{{ $product->product_id }}">Harga</label>
                                                    <input type="number" class="form-control" id="edit_price{{ $product->product_id }}" name="price" value="{{ $product->price }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_weight{{ $product->product_id }}">Berat</label>
                                                    <input type="number" class="form-control" id="edit_weight{{ $product->product_id }}" name="weight" value="{{ $product->weight }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_img_url{{ $product->product_id }}">URL Gambar</label>
                                                    <input type="text" class="form-control" id="edit_img_url{{ $product->product_id }}" name="img_url" value="{{ $product->img_url }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>

        <!-- Modal Hapus Produk -->
        <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" data-target="#hapusProduk{{ $product->product_id }}">
            <i class="fas fa-trash-restore mr-1"></i>Hapus
        </button>

        <div class="modal fade" id="hapusProduk{{ $product->product_id }}" tabindex="-1" role="dialog" aria-labelledby="hapusProdukLabel{{ $product->product_id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusProdukLabel{{ $product->product_id }}">Hapus Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus produk "{{ $product->name }}"?
                    </div>
                    <div class="modal-footer">
                        <!-- Form untuk menghapus produk -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                        <form action="{{ url('/product/' . $product->product_id) }}" method="post">
                            @method('DELETE')
                            @csrf
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
    });
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
    swal("Success!", "Data Produk Berhasil Di Tambahkan", "success");
</script>
@endif

@if (session('update'))
<script>
    swal("Success!", "Data Produk Berhasil Di Update", "success");
</script>
@endif

@if (session('delete'))
<script>
    swal("Success!", "Data Produk Berhasil Di Hapus", "success");
</script>
@endif
@endsection