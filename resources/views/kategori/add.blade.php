@extends('layouts.main')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Tambah Data Kategori</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Kategori</div>
            <div class="breadcrumb-item">Tambah Data Kategori</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_kategori') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Kategori
                        </a>
                    </div>
                </div>
                <form action="{{ route('post_kategori') }}" method="POST" enctype="multipart/form-data">
                    @csrf    
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label class="control-label" for="name">Nama Kategori</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            <div class="text-danger">
                                @error('name')
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