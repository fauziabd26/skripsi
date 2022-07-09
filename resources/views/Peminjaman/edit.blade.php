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
                <form action="/Peminjaman/update/{{ $kem->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')    
                    @csrf
					<div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="nama_peminjam">Nama Peminjam</label>
						@foreach($mahasiswa as $m)
						<?php if ($m->Mahasiswa_id == $kem->nama_peminjam) { ?>
							<select class="form-control" name="nama_peminjam" id="nama_peminjam">
								@foreach ($mahasiswa as $data)
                                <option value="{{ $data->Mahasiswa_id }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('nama_peminjam')
                                    {{ $message }}
                                @enderror
                            </div>
						<?php } ?>
                        @endforeach
                        </div>
						<div class="form-group col-6 col-md-3 col-lg-3"> 
                            <label class="control-label">Nama Dosen</label>
                            <select class="form-control" name="namaDosen" id="namaDosen">
						<?php if ($m->Mahasiswa_id == $kem->nama_peminjam ) { ?>
                                @foreach ($dosen as $datad)
                                <option value="{{ $datad->Dosen_id }}">{{ $datad->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('namaDosen')
                                    {{ $message }}
                                @enderror
                            </div>
						<?php } ?>
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
                        <label class="control-label">Pilih Nama Barang</label>
                    </div>
						@foreach($peminjaman as $bp)
							<?php if ($kem->kode_barang_peminjaman == $bp->kode) { ?>
					<div class="row" id="dynamic_field" name="dynamic_field">
                        <input type="hidden" class="form-control" name="id_bp[]" id="id_bp" value="{{ $bp->id }}">
                        <input type="hidden" class="form-control" name="kode_bp" id="kode_bp" value="{{ $bp->kode }}">
						
						<div class="form-group col-6 col-md-3 col-lg-3"> 
                            <label class="control-label">Barang saat ini : {{ $bp->b_name }}</label>
                            <select class="form-control" name="namaBarang1[]" id="namaBarang1">
                                @foreach ($barang as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('namaBarang1')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label">jumlah barang</label>
                            <input type="number" class="form-control" name="jumlahBarang1[]" id="jumlahBarang1" value="{{ $bp->jumlah }}">
                            <div class="text-danger">
                                @error('jumlahBarang1')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
						<div class="form-group col-6 col-md-3 col-lg-3">
							<br>
							<a href="/Peminjaman/edit/deletebarang/{{$bp->id}}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus barang ini ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
						</div>
						<div class="text-danger">
                            @error('dynamic_field')
                               {{ $message }}
                            @enderror
                        </div>
                    </div>
							<?php } ?>
                        @endforeach
					<div name="add_name" id="add_name">
					</div>
					
                    <div class="row">
						<div class="col-2">
							<br/><button type="button" name="add" id="add" class="btn btn-primary mb-3">Add More</button></td> 
                        </div>
					</div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="aprovals">Pilih Aproval Peminjaman</label>
                            <select name="aprovals" id="aprovals" class="form-control">
								<?php if ($kem->aprovals == "Ya") { ?>
									<option value="Ya" selected>Ya</option>
									<option value="Tidak">Tidak</option>
								<?php } ?>
								<?php if ($kem->aprovals == "Tidak") { ?>
									<option value="Ya">Ya</option>
									<option value="Tidak" selected>Tidak</option>
								<?php } ?>
                            </select>
                            <div class="text-danger">
                                @error('aprovals')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="status">Pilih Status Peminjaman</label>
                            <select name="status" class="form-control">
								<?php if ($kem->status == "Dipinjam") { ?>
									<option value="Dipinjam" selected>Dipinjam</option>
									<option value="Dikembalikan">Dikembalikan</option>
								<?php } ?>
								<?php if ($kem->status == "Dikembalikan") { ?>
									<option value="Dipinjam">Dipinjam</option>
									<option value="Dikembalikan" selected>Dikembalikan</option>
								<?php } ?>
                            </select>
                            <div class="text-danger">
                                @error('status')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
					
					<script type="text/javascript">
						$(document).ready(function(){      
						var url = "{{ url('post_create_Peminjaman') }}";
						var i=1;  
						$('#add').click(function(){  
						var namaBarang = $("#namaBarang").val();
						var jumlahBarang = $("#jumlahBarang").val();

						i++;  
						$('#add_name').append('<div class="row" id="row'+i+'"><div class="form-group col-6 col-md-3 col-lg-3"><label class="control-label">Pilih Nama Barang</label><select class="form-control" name="namaBarang[]" id="namaBarang"><option value="" disabled selected> Semua Nama Barang </option>@foreach ($barang as $data)<option value="{{ $data->id }}">{{ $data->name }}</option> @endforeach</select>@error('barangID.0') <span class="text-danger error">{{ $message }}</span>@enderror</div><div class="form-group col-6 col-md-3 col-lg-3"><label class="control-label">jumlah barang</label><input type="number" class="form-control" name="jumlahBarang[]" id="jumlahBarang">@error('jumlah.0') <span class="text-danger error">{{ $message }}</span>@enderror</div><br/><div class="col-2" id="'+i+'"><br/><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></td></div></div>');

						});  
						$(document).on('click', '.btn_remove', function(){  
						var button_id = $(this).attr("id");   
						$('#row'+button_id+'').remove();  
						});  
						$.ajaxSetup({
						headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
						});
						$('#submit').click(function(){            
						$.ajax({  
						url:"{{ url('post_create_Paket') }}",  
						method:"POST",  
						data:$('#add_name').serialize(),
						type:'json',
						success:function(data)  
						{
						if(data.error){
						display_error_messages(data.error);
						}else{
						i=1;
						$('.dynamic-added').remove();
						$('#add_name')[0].reset();
						$(".show-success-message").find("ul").html('');
						$(".show-success-message").css('display','block');
						$(".show-error-message").css('display','none');
						$(".show-success-message").find("ul").append('<li>Todos Has Been Successfully Inserted.</li>');
						}
						}  
						});  
						});  
						function display_error_messages(msg) {
						$(".show-error-message").find("ul").html('');
						$(".show-error-message").css('display','block');
						$(".show-success-message").css('display','none');
						$.each( msg, function( key, value ) {
						$(".show-error-message").find("ul").append('<li>'+value+'</li>');
						});
						}
						});  
					</script>
                        <div class="form-group">
                            <input type="submit"  value="Simpan" class="btn btn-primary">
                        </div>
                </form>
            </div>
        </div>
    </div>

</section>
@stop