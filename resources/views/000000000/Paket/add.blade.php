@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Data Peminjaman</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Tambah Data Peminjaman</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_Paket') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Peminjaman
                        </a>
                    </div>
                </div>
                <form action="{{ route('post_create_Paket') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
					<div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="nama">Nama Paket</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                            <div class="text-danger">
                               @error('nama')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}">
                            <div class="text-danger">
                               @error('keterangan')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="Nama Barang">Pilih Nama Barang</label>
                            <select name="nama_barang1" class="form-control">
                                <option disabled selected> Semua Nama Barang </option>
                                @foreach ($Barang as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('Nama Barang')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="keterangan">jumlah</label>
                            <input type="number" name="jumlah1" class="form-control" value="{{ old('jumlah') }}">
                            <div class="text-danger">
                               @error('jumlah')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="Nama Barang">Pilih Nama Barang</label>
                            <select name="nama_barang2" class="form-control">
                                <option disabled selected> Semua Nama Barang </option>
                                @foreach ($Barang as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('Nama Barang')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="keterangan">jumlah</label>
                            <input type="number" name="jumlah2" class="form-control" value="{{ old('jumlah2') }}">
                            <div class="text-danger">
                               @error('jumlah2')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection