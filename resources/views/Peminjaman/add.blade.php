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
					@if ($message = Session::get('gagal'))
							<div class="alert alert-danger alert-block">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<strong>{{ $message }}</strong>
							</div>
					@endif
                    <div class="col">
                        <a href="{{ route('index_Peminjaman') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Peminjaman
                        </a>
                    </div>
                </div>
                <form action="{{ route('post_Peminjaman') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="nama_peminjam">Nama Peminjam</label>
							<select class="form-control" name="nama_peminjam" id="nama_peminjam">
								@foreach ($mahasiswa as $data)
                                <option value="{{ $data->Mahasiswa_id }}">{{ $data->nim }} - {{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('nama_peminjam')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="namaDosen">Nama Dosen</label>
							<select class="form-control" name="namaDosen" id="namaDosen">
								@foreach ($dosen as $data)
                                <option value="{{ $data->Dosen_id }}">{{ $data->nip }} - {{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('nama_peminjam')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
					 <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="tanggal_peminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggal_peminjaman" class="form-control">
                            <div class="text-danger">
                                @error('tanggal_peminjaman')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="waktu_peminjaman">Waktu Peminjaman</label>
                            <input type="time" name="waktu_peminjaman" class="form-control">
                            <div class="text-danger">
                                @error('waktu_peminjaman')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
					 <div class="row">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="waktu_peminjaman">Keterangan</label>
                            <input type="text" name="Keterangan" class="form-control">
                            <div class="text-danger">
                                @error('Keterangan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
					<div class="row" id="dynamic_field">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label">Pilih Nama Barang</label>
                            <select class="form-control" name="namaBarang[]" id="namaBarang">
                                @foreach ($Barang as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label">jumlah barang</label>
                            <input type="number" class="form-control" name="jumlahBarang[]" id="jumlahBarang">
                        </div><br/>
						<div class="col-2">
							<br/><button type="button" name="add" id="add" class="btn btn-primary mb-3">Add More</button></td> 
                        </div>
                    </div>
					<div name="add_name" id="add_name">
					</div>
							<input type="hidden" id="aproval" name="aproval" value="ya"readonly>
							<input type="hidden" id="status" name="status" value="Dipinjam"readonly>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm">Simpan</button>
                    </div>
					<script type="text/javascript">
						$(document).ready(function(){      
						var url = "{{ url('post_create_Peminjaman') }}";
						var i=1;  
						$('#add').click(function(){  
						var namaBarang = $("#namaBarang").val();
						var jumlahBarang = $("#jumlahBarang").val();

						i++;  
						$('#add_name').append('<div class="row" id="row'+i+'"><div class="form-group col-6 col-md-3 col-lg-3"><label class="control-label">Pilih Nama Barang</label><select class="form-control" name="namaBarang[]" id="namaBarang"><option value="" disabled selected> Semua Nama Barang </option>@foreach ($Barang as $data)<option value="{{ $data->id }}">{{ $data->name }}</option> @endforeach</select>@error('barangID.0') <span class="text-danger error">{{ $message }}</span>@enderror</div><div class="form-group col-6 col-md-3 col-lg-3"><label class="control-label">jumlah barang</label><input type="number" class="form-control" name="jumlahBarang[]" id="jumlahBarang">@error('jumlah.0') <span class="text-danger error">{{ $message }}</span>@enderror</div><br/><div class="col-2" id="'+i+'"><br/><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></td></div></div>');

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
				</form>
			</div>
		</div>
	</div>
</section>
@endsection
