@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Data Pengembalian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Tambah Data Pengembalian</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_Pengembalian') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Pengembalian
                        </a>
                    </div>
                </div>
                <form action="{{ route('post_Pengembalian') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
					<div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="nama_barang">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}">
                                <div class="text-danger">
                                    @error('nama_barang')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="nama_peminjam">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" class="form-control" value="{{ old('nama_peminjam') }}">
                            <div class="text-danger">
                               @error('nama_peminjam')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="jumlah_pengembalian">Jumlah Pengembalian</label>
                            <input type="number" name="jumlah_pengembalian" class="form-control" value="{{ old('jumlah_pengembalian') }}">
                            <div class="text-danger">
                               @error('jumlah_pengembalian')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
					 <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="tanggal_pengembalian">Tanggal Pengembalian</label>
                            <input type="date" name="tanggal_pengembalian" class="form-control" value="{{ old('tanggal_pengembalian') }}">
                            <div class="text-danger">
                               @error('tanggal_pengembalian')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="tanggal_peminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggal_peminjaman" class="form-control" value="{{ old('tanggal_peminjaman') }}">
                            <div class="text-danger">
                               @error('tanggal_peminjaman')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
						 <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="waktu_peminjaman">Waktu Peminjaman</label>
                            <input type="time" name="waktu_peminjaman" class="form-control" value="{{ old('waktu_peminjaman') }}">
                            <div class="text-danger">
                                @error('waktu_peminjaman')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="kondisi">Pilih Kondisi Barang</label>
                            <select name="kondisi" class="form-control">
                                <option disabled> Kondisi Barang </option>
                                @foreach ($data as $k)
                                <option value="{{ $k->name }}">{{ $k->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('kondisi')
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