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
					@if ($message = Session::get('gagal'))
							<div class="alert alert-danger alert-block">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<strong>{{ $message }}</strong>
							</div>
					@endif
					@if ($message = Session::get('kosong'))
							<div class="alert alert-danger alert-block">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<strong>{{ $message }}</strong>
							</div>
					@endif
                        <a href="{{ route('index_Peminjaman') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data peminjaman
                        </a>
                    </div>
                </div>
                <form action="/PeminjamanPaket/edit/post/{{ $kem->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')    
                    @csrf
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
						@foreach ($paket as $data)
							<?php if ($kem->kode_paket == $data->id_paket) { ?>
                            <label class="control-label" for="nama_paket">Nama Paket</label>
                            <select name="nama_paket" class="form-control">
                                <option value="{{ $data->id }}" selected disabled> {{ $data->nama }} </option>
                                @foreach ($paket as $data1)
                                <option value="{{ $data1->id }}">{{ $data1->nama }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('nama_paket')
                                    {{ $message }}
                                @enderror
                            </div>
							<?php } ?>
						@endforeach
                        </div>
                    </div>
					 <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label">jumlah Paket</label>
                            <input type="number" class="form-control" name="jumlahPaket" id="jumlahPaket" value="{{ $kem->jumlah_peminjaman }}">
                            <div class="text-danger">
                                @error('jumlahPaket')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="tanggal_peminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggal_peminjaman" class="form-control" value="{{ $kem->tanggal_peminjaman }}">
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
                            <input type="time" name="waktu_peminjaman" class="form-control" value="{{ $kem->waktu_peminjaman }}">
                            <div class="text-danger">
                                @error('waktu_peminjaman')
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