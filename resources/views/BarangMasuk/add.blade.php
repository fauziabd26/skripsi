@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Data Barang Masuk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Barang Masuk</div>
            <div class="breadcrumb-item">Tambah Data Barang Masuk</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_barang_masuk') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Barang Masuk
                        </a>
                    </div>
                </div>
                <form action="{{route('post_barangmasuk')}}" method="POST" enctype="multipart/form-data">
                    @csrf    
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label class="control-label" for="name">Nama Barang Masuk</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" autofocus>
                            <div class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="stok">Stok Awal Barang</label>
                            <input type="number" min="0" name="stok" class="form-control" value="{{ old('stok') }}" >
                            <div class="text-danger">
                                @error('stok')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="kategori_id">Kategori Barang</label>
                            <select name="kategori_id" class="form-control" >
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
                            <select name="satuan_id" class="form-control" >
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
                            <label class="control-label" for="tggl_masuk">Tanggal Masuk</label>
                            <input type="date" name="tggl_masuk" class="form-control" value="{{ old('tggl_masuk') }}" >
                            <div class="text-danger">
                                @error('tggl_masuk')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label class="control-label" for="nama_konsumen">Nama Konsumen</label>
                            <input type="text" name="nama_konsumen" class="form-control" value="{{ old('nama_konsumen') }}" >
                            <div class="text-danger">
                                @error('nama_konsumen')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="file">Gambar Barang</label>
                            <input type="file" name="file" class="form-control" value="{{ old('file') }}">
                            <div class="text-danger">
                               @error('file')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection