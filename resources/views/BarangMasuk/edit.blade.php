@extends('layouts.main')

@section('content')
<section class="section">
<div class="section-header">
        <h1>Edit Data Barang Masuk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Data Barang Masuk</div>
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
                <form action="{{ route('update_barang_masuk',$barangmasuk->id) }}" method="POST">
                    @csrf
                    @method('PUT')    
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label class="control-label" for="barang_id">Nama Barang</label>
                            <input type="text" class="form-control" value="{{ $barangmasuk->barang->name }}" disabled>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="suppliers_id">Nama Supplier</label>
                            <select class="form-control" name="suppliers_id" id="suppliers_id">
                            <option selected disabled> Pilih Supplier Barang </option>
								@foreach ($suppliers as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('suppliers_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="stok">Stok Barang</label>
                            <input type="number" name="stok" min="0" class="form-control" value="{{ $barangmasuk->stok }}">
                            <div class="text-danger">
                               @error('stok')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label class="control-label" for="tggl_masuk">Tanggal Masuk</label>
                            <input type="date" name="tggl_masuk" class="form-control" value="{{ old('tggl_masuk') }}" >
                            <div class="text-danger">
                                @error('tggl_masuk')
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
@stop