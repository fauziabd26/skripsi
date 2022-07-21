@extends('layouts.main')

@section('content')

<section class="section">
<div class="section-header">
        <h1>Edit Data Suppliers</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Data Suppliers</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_suppliers') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Suppliers
                        </a>
                    </div>
                </div>
                <form action="{{ route('update_suppliers',$suppliers->id) }}" method="POST">
                @csrf
                @method('PUT')    
                    <div class="row">
                       <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="name">Nama Suppliers</label>
                                <input type="text" name="name" class="form-control" value="{{ $suppliers->name }}">
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="alamat">Alamat Suppliers</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $suppliers->alamat }}">
                                <div class="text-danger">
                                    @error('alamat')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="email">Email Suppliers</label>
                                <input type="text" name="email" class="form-control" value="{{ $suppliers->email }}">
                                <div class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                                <label class="control-label" for="telepon">Nomor Telepon Suppliers</label>
                                <input type="text" name="telepon" class="form-control" value="{{ $suppliers->telepon }}">
                                <div class="text-danger">
                                    @error('telepon')
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