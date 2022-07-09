@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Peminjaman</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Peminjaman</div>
			<div class="breadcrumb-item">Peminjam Paket Barang</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    @if ($message = Session::get('sukses'))
							<div class="alert alert-success alert-block">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<strong>{{ $message }}</strong>
							</div>
						@endif
						@if ($message = Session::get('gagal'))
							<div class="alert alert-danger alert-block">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<strong>{{ $message }}</strong>
							</div>
						@endif
						<br>
						<?php if (Auth::user()->name == "admin") { ?>
						<div class="col">
                        <a href="{{ route('Peminjaman_paket') }}" class="btn btn-primary" title="Kembali" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali
                        </a>
						<?php } ?>
						<?php if (Auth::user()->name != "admin") { ?>
						<div class="col">
                        <a href="{{ route('index_Peminjaman_pengguna') }}" class="btn btn-primary" title="Kembali" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali
                        </a>
						<?php } ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama Paket</th>
                                <th>Jumlah</th>
                                <th>keterangan</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php 
							$no = 1;
						?>
                        @foreach($data as $b)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ $b->nama }}</td>
                            <td align="center">{{ $b->jumlah }}</td>
                            <td align="center">{{ $b->keterangan }} </td>
                            <td align="center">
								<button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat<?php echo $b['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Lihat</i></button>
								<button class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#modal-pinjam<?php echo $b['id']; ?>"><i class="fa fa-pen" aria-hidden="true"> Pinjam</i></button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal Lihat -->
<?php if (!empty($data)) { ?>
    <?php foreach ($data as $b) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-lihat<?php echo $b['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Peminjaman </h5>
                    </div>
                    <div class="modal-body">
					<div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">Nama Paket</div>
                                <div class="col-md-6 ms-auto"><?= $b['nama'] ?></div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">Jumlah Paket</div>
                                <div class="col-md-6 ms-auto"><?= $b['jumlah'] ?></div>
                            </div><br>
							@foreach($pbarang as $pb)
							@foreach($barang as $ba)
							<?php if ($ba->id == $pb->id_barang && $b->kode == $pb->kode) { ?>
                            <div class="row">
                                <div class="col-md-4">Barang</div>
                                <div class="col-md-6 ms-auto"><?= $ba['name'] ?> Jumlah <?= $pb['jumlah'] ?></div>
                            </div><br>
							<?php } ?>
							@endforeach
							@endforeach
                            <div class="row">
                                <div class="col-md-4">Keterangan</div>
                                <div class="col-md-6 ms-auto"><?= $b['keterangan'] ?></div>
                            </div><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>
<!-- END Modal Lihat -->

<!-- Modal Pinjam -->
<?php if (!empty($data)) { ?>
    <?php foreach ($data as $b) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-pinjam<?php echo $b['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Peminjaman </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
					
						
					<form action="/PenggunaMahasiswapaket/add/{{$b->id}}" method="POST">
						@csrf
                    <div class="modal-body">
						<input type="hidden" id="k_paket" name="k_paket" value="<?= $b['id'] ?>"readonly><br><br>
						
						<label>Nama Peminjam	&emsp;&emsp;&emsp;:</label>
						<input type="text" id="n_peminjam" name="n_peminjam"><br><br>
						
						<label>Jumlah Peminjaman &emsp;&ensp;:</label>
						<input type="number" id="j_peminjam" name="j_peminjam"><br><br>
						
						<label>Tanggal Peminjaman	&emsp;:</label>
						<input type="date" id="t_peminjaman" name="t_peminjaman"><br><br>
						
						<label>waktu peminjaman	&emsp;&emsp;:</label>
						<input type="time" id="w_peminjaman" name="w_peminjaman"><br><br>
						
						
                    </div>
					
                    <div class="modal-footer">
                        <button class="btn btn-warning btn-sm mr-2">Kirim</button>
                    </div>
					</form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>
<!-- END Modal Pinjam -->


@stop