@extends('layouts.main')

@section('content')

<section class="section">
<div class="section-header">
        <h1>Edit Data Dosen</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Data Dosen</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_dosen') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Dosen
                        </a>
                    </div>
                </div>
                <form action="{{ route('update_dosen',$dosen->id) }}" method="POST">
                @csrf
                @method('PUT')    
                    <div class="row">
                       <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="nip">Nip dosen</label>
                                <input type="text" name="nip" class="form-control" value="{{ $dosen->nip }}">
                                <div class="text-danger">
                                    @error('nip')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="name">Nama dosen</label>
                                <input type="text" name="name" class="form-control" value="{{ $dosen->name }}">
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label class="control-label" for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{ $dosen->keterangan }}">
                            <div class="text-danger">
                                @error('keterangan')
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