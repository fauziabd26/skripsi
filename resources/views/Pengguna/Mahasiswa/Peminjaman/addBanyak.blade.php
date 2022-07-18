@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Data Peminjaman</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
			<div class="breadcrumb-item">Peminjaman</div>
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
                        <a href="{{ route('index_Peminjaman_pengguna') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Peminjaman
                        </a>
                    </div>
                </div>
				<?php $no = 1;?>
				<form action="{{ route('post_create_Peminjaman') }}" method="POST" enctype="multipart/form-data">    
                    @csrf  
					<div class="alert alert-danger show-error-message" style="display:none">
						<ul></ul>
					</div>
					<div class="alert alert-success show-success-message" style="display:none">
						<ul></ul>
					</div>
					
					<div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            @foreach ($mahasiswa as $datanama)
							<?php if (Auth::user()->id == $datanama->id_Mahasiswa) { ?>
                            <label class="control-label">Nama Peminjam</label>
                            <select class="form-control" name="n_peminjam" id="n_peminjam">
								<option value="{{ $datanama->id_Mahasiswa }}" selected> {{ $datanama->name }} </option>
                            </select>
							<div class="text-danger">
                                @error('n_peminjam')
                                    {{ $message }}
                                @enderror
                            </div>
							<?php } ?>
                            @endforeach
                        </div>
						<input type="hidden" name="kode" id="kode" value="pkt{{ $no++ }}" class="form-control">
                       <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label">Pilih Nama Dosen</label>
                            <select class="form-control" name="namaDosen" id="namaDosen">
								<option disabled selected> Semua Nama Dosen </option>
                                @foreach ($dosen as $data)
                                <option value="{{ $data->id_dosen }}">{{ $data->name }}</option> 
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('namaDosen')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label">Tanggal Peminjaman</label>
                            <input type="date" name="t_peminjaman" id="t_peminjaman" class="form-control">
                            <div class="text-danger">
                                @error('t_peminjaman')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label">Waktu Peminjaman</label>
                            <input type="time" name="w_peminjaman" id="w_peminjaman" class="form-control">
                            <div class="text-danger">
                                @error('w_peminjaman')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
					</div>
					<div class="row">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="Keterangan">Keterangan</label>
                            <input type="text" name="Keterangan" id="Keterangan" class="form-control">
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
						
                        <div class="form-group">
                            <input type="submit"  value="Simpan" class="btn btn-primary">
                        </div>
				</form>  
            </div>
		</div>
	</div>
</section>
	
@endsection
