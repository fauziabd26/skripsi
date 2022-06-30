@extends('layouts.main')

@section('content')
<section class="section">
<div class="section-header">
        <h1>Edit Data peminjaman</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Data peminjaman</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_Peminjaman') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data peminjaman
                        </a>
                    </div>
                </div>
                <form action="/Peminjaman/update/{{ $kem->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')    
                    @csrf
                    <div class="row">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="kode_barang">Pilih Kode Barang</label>
                            <select name="kode_barang" class="form-control">
                                <option value="{{ $kem->kode_barang }}" disabled selected> {{ $kem->kode_barang }} </option>
                                @foreach ($Barang as $data)
                                <option value="{{ $data->id }}">{{ $data->id }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('kode_barang')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="nama_barang">Pilih Nama Barang</label>
                            <select name="nama_barang" class="form-control">
                                <option value="{{ $kem->nama_barang }}" disabled selected> {{ $kem->nama_barang }} </option>
                                @foreach ($Barang as $data)
                                <option value="{{ $data->name }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('nama_barang')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
						
                    </div>
					<div class="row">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="kategori_barang">Pilih Kategori Barang</label>
                            <select name="kategori_barang" class="form-control">
                                <option value="{{ $kem->kategori_barang }}" disabled selected> {{ $kem->kategori_barang }} </option>
                                @foreach ($kategoris as $data)
                                <option value="{{ $data->name }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('kategori_barang')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="satuan_barang">Pilih Satuan Barang</label>
                            <select name="satuan_barang" class="form-control">
                                <option value="{{ $kem->satuan_barang }}" disabled selected> {{ $kem->satuan_barang }} </option>
                                @foreach ($satuans as $data)
                                <option value="{{ $data->name }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                               @error('satuan_barang')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="nama_peminjam">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" class="form-control" value="{{ $kem->nama_peminjam }}">
                            <div class="text-danger">
                               @error('nama_peminjam')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="jumlah_peminjam">Jumlah Peminjam</label>
                            <input type="number" name="jumlah_peminjam" class="form-control" value="{{ $kem->jumlah_peminjam }}">
                            <div class="text-danger">
                               @error('jumlah_peminjam')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
					 <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="tanggal_peminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggal_peminjaman" class="form-control" value="{{ $kem->tanggal_peminjaman }}">
                            <div class="text-danger">
                               @error('tanggal_peminjaman')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="waktu_peminjaman">Waktu Peminjaman</label>
                            <input type="time" name="waktu_peminjaman" class="form-control" value="{{ $kem->waktu_peminjaman }}">
                            <div class="text-danger">
                                @error('waktu_peminjaman')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="aprovals">Pilih Aproval Peminjaman</label>
                            <select name="aprovals" class="form-control">
                                <option value="{{ $kem->aprovals }}" disabled selected> {{ $kem->aprovals }} </option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                            <div class="text-danger">
                               @error('aprovals')
                                   {{ $message }}
                               @enderror
                            </div>
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