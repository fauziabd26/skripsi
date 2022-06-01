@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Aproval</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Aproval</div>
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
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>Kategori Barang</th>
                                <th>Satuan Barang</th>
                                <th>Nama Peminjam</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php 
							$no = 1;
						?>
                        @foreach($data as $b)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ $b->nama_barang }}</td>
                            <td align="center">{{ $b->kategori_barang }}</td>
                            <td align="center">{{ $b->satuan_barang }} </td>
                            <td align="center">{{ $b->nama_peminjam }}</td>
                            <td align="center">
								<button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat<?php echo $b['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Lihat</i></button>
								<button class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#modal-pinjam<?php echo $b['id']; ?>"><i class="fa fa-check" aria-hidden="true"> Setuju</i></button>
								<a href="/PenggunaDosen/delete/{{$b->id}}" onclick="return confirm('Apakah Anda Yakin Tidak Menyetujui Data Ini?');" class="btn btn-danger btn-sm"><i class="fa fa-ban">Tidak</i></a>
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
                        <h5 class="modal-title">Data Peminjaman </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Kode Barang      		&emsp;&emsp;&emsp;&emsp;&emsp;: {{ $b->kode_barang }}</p>
						<p>Nama Barang      		&emsp;&emsp;&emsp;&emsp;&ensp;: {{ $b->nama_barang }}</p>
						<p>Kategori Barang  		&emsp;&emsp;&emsp;&ensp;: {{ $b->kategori_barang }}</p>
						<p>Satuan Barang    		&emsp;&ensp;&emsp;&emsp;&ensp;: {{ $b->satuan_barang }}</p>
						<p>Nama Peminjam    		&emsp;&ensp;&emsp;&emsp;: {{ $b->nama_peminjam }}</p>
						<p>Jumlah Peminjaman  		&emsp;&emsp;: {{ $b->jumlah_peminjaman }}</p>
						<p>Tanggal Peminjaman  		&emsp;&ensp;: {{ $b->tanggal_peminjaman }}</p>
						<p>waktu Peminjaman  		&emsp;&emsp;: {{ $b->waktu_peminjaman }}</p>
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
                        <h5 class="modal-title">Data Peminjaman </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
					
						
					<form action="/PenggunaDosen/add" method="POST">
						@csrf
                    <div class="modal-body">
						<label>Kode Barang		&emsp;&emsp;&emsp;&emsp;&ensp;:</label>
						<input type="text" id="k_barang" name="k_barang" value="<?= $b['kode_barang'] ?>"readonly><br><br>
						
						<label>Nama Barang		&emsp;&emsp;&emsp;&emsp;:</label>
						<input type="text" id="n_barang" name="n_barang" value="<?= $b['nama_barang'] ?>"readonly><br><br>
						
						<label>Kategori Barang	&emsp;&emsp;&emsp;:</label>
						<input type="text" id="kategori_b" name="kategori_b" value="<?= $b['kategori_barang'] ?>"readonly><br><br>
						
						<label>Satuan Barang	&emsp;&ensp;&emsp;&emsp;:</label>
						<input type="text" id="s_barang" name="s_barang" value="<?= $b['satuan_barang'] ?>"readonly><br><br>
						
						<label>Nama Peminjam	&emsp;&emsp;&emsp;:</label>
						<input type="text" id="n_peminjam" name="n_peminjam" value="<?= $b['nama_peminjam'] ?>"readonly><br><br>
						
						<label>Jumlah Peminjaman &emsp;&ensp;:</label>
						<input type="text" id="j_peminjam" name="j_peminjam" value="<?= $b['jumlah_peminjaman'] ?>"readonly><br><br>
						
						<label>Tanggal Peminjaman	&emsp;:</label>
						<input type="date" id="t_peminjaman" name="t_peminjaman" value="<?= $b['tanggal_peminjaman'] ?>"readonly><br><br>
						
						<label>waktu peminjaman	&emsp;&emsp;:</label>
						<input type="time" id="w_peminjaman" name="w_peminjaman" value="<?= $b['waktu_peminjaman'] ?>"readonly><br><br>
						<input type="hidden" id="aproval" name="aproval" value="ya"readonly><br><br>
						
						
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