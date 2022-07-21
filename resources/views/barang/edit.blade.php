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
                <form action="/barang/update/{{ $barang->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')    
                    @csrf
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="name">Nama Barang</label>
                                <input type="text" name="name" class="form-control" value="{{ $barang->name }}">
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="stok">Stok Barang</label>
                            <input type="number" name="stok" min="0" class="form-control" value="{{ $barang->stok }}">
                            <div class="text-danger">
                               @error('stok')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="k_name">Pilih Kategori Barang</label>
                            <select name="kategori_id" class="form-control">
                                <option disabled> Semua Kategori </option>
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
                            <label class="control-label" for="s_name">Pilih Satuan Barang</label>
                            <select name="satuan_id" class="form-control">
                                <option disabled> Satuan Barang </option>
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
                            <label class="control-label" for="kondisi_id">Pilih Kondisi Barang</label>
                            <select name="kondisi_id" class="form-control">
                                <option disabled>Pilih Kondisi Barang </option>
                                @foreach ($kondisis as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('kondisi_id')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="file">Ganti Gambar Barang</label>
                            <input type="file" name="file" accept=".jpg, .png, .jpeg" class="form-control">
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
                            <img src="{{ url('img/barang/'.$barang->file) }}" width="200px" alt="">
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