@extends('layouts.main')

@section('content')

<section class="section">
<div class="section-header">
        <h1>Edit Data Mahasiswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Data Mahasiswa</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_mahasiswa') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Mahasiswa
                        </a>
                    </div>
                </div>
                <form action="{{ route('update_mahasiswa',$mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')    
                    <div class="row">
                       <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="nim">Nim Mahasiswa</label>
                                <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}">
                                <div class="text-danger">
                                    @error('nim')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="name">Nama Mahasiswa</label>
                                <input type="text" name="name" class="form-control" value="{{ $mahasiswa->name }}">
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label class="control-label" for="name">Kelas</label>
                            <input type="text" name="kelas" class="form-control" value="{{ $mahasiswa->kelas }}">
                            <div class="text-danger">
                                @error('kelas')
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