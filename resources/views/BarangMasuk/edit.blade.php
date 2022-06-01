@extends('layouts.main')

@section('content')
<section class="section">
<div class="section-header">
        <h1>Edit Data Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Data Barang</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_barang') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Barang
                        </a>
                    </div>
                </div>
                <form action="/barang_masuk/update/{{ $BarangMasuk->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')    
                    @csrf
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label class="control-label" for="id">Kode Barang</label>
                            <input type="number" name="id" class="form-control" value="{{ $Barang->id }}">
                            <div class="text-danger">
                               @error('id')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="name">Nama Barang</label>
                                <input type="text" name="name" class="form-control" value="{{ $Barang->name }}">
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="file">Nama Konsumen</label>
                            <input type="text" name="nama_konsumen" class="form-control" value="{{ $BarangMasuk->nama_konsumen }}">
                            <div class="text-danger">
                                    @error('nama_konsumen')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="stok">Stok Barang</label>
                            <input type="number" min="0" name="stok" class="form-control" value="{{ $Barang->stok }}">
                            <div class="text-danger">
                               @error('stok')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="kategori_id">Kategori Barang</label>
                            <select name="kategori_id" class="form-control">
                                <option selected disabled> Pilih Kategori Barang </option>
                                @foreach ($kategoris as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('kategori_id')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="satuan_id">Pilih Satuan Barang</label>
                            <select name="satuan_id" class="form-control">
                                <option selected disabled>Pilih Satuan Barang </option>
                                @foreach ($satuans as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('satuan_id')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="file">Tanggal Masuk Barang</label>
                            <input type="date" name="tggl_masuk" class="form-control" value="{{ $BarangMasuk->tggl_masuk }}">
                            <div class="text-danger">
                               @error('tggl_masuk')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="file">Gambar Barang</label>
                            <input type="file" name="file" class="form-control" >
                            <div class="text-danger">
                               @error('file')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="s_name">Foto Gambar Barang Sebelumnya</label>
                            <img src="{{ url('img/barang/'.$Barang->file) }}" width="200px" alt="">
                        </div>
                    </div>
                        <div class="form-group">
                            <input type="submit"  value="Simpan" class="btn btn-primary">
                        </div>
                </form>
            </div>
        </div>
    </div>

</section>
@stop