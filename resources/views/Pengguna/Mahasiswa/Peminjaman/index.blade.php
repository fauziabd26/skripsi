@extends('layoutMahasiswa.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Peminjaman</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Peminjaman</div>
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
                                <th>stok</th>
                                <th>Kategori Barang</th>
                                <th>Satuan Barang</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php 
							$no = 1;
						?>
                        @foreach($barang as $b)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ $b->name }}</td>
                            <td align="center">{{ $b->stok }}</td>
                            <td align="center">{{ $b->k_name }} </td>
                            <td align="center">{{ $b->s_name }}</td>
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
<?php if (!empty($barang)) { ?>
    <?php foreach ($barang as $b) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-lihat<?php echo $b['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Peminjaman </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Kode Barang      &emsp;&emsp;&emsp;&emsp;&ensp;: <?= $b['id'] ?></p>
                        <p>Nama Barang      &emsp;&emsp;&emsp;&emsp;: <?= $b['name'] ?></p>
                        <p>stok             &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;: <?= $b['stok'] ?></p>
                        <p>Kategori Barang  &emsp;&emsp;&emsp;: <?= $b['k_name'] ?></p>
                        <p>Satuan Barang    &emsp;&ensp;&emsp;&emsp;: <?= $b['s_name'] ?></p>
                        <p>Gambar Barang    &emsp;&emsp;&emsp;: <?= $b['file'] ?></p>
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
<?php if (!empty($barang)) { ?>
    <?php foreach ($barang as $b) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-pinjam<?php echo $b['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Peminjaman </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
					
						
					<form action="/PenggunaMahasiswa/add" method="POST">
						@csrf
                    <div class="modal-body">
						<label>Kode Barang		&emsp;&emsp;&emsp;&emsp;&ensp;:</label>
						<input type="text" id="k_barang" name="k_barang" value="<?= $b['id'] ?>"readonly><br><br>
						
						<label>Nama Barang		&emsp;&emsp;&emsp;&emsp;:</label>
						<input type="text" id="n_barang" name="n_barang" value="<?= $b['name'] ?>"readonly><br><br>
						
						<label>Kategori Barang	&emsp;&emsp;&emsp;:</label>
						<input type="text" id="kategori_b" name="kategori_b" value="<?= $b['k_name'] ?>"readonly><br><br>
						
						<label>Satuan Barang	&emsp;&ensp;&emsp;&emsp;:</label>
						<input type="text" id="s_barang" name="s_barang" value="<?= $b['s_name'] ?>"readonly><br><br>
						
						<label>Nama Peminjam	&emsp;&emsp;&emsp;:</label>
						<input type="text" id="n_peminjam" name="n_peminjam"><br><br>
						
						<label>Jumlah Peminjaman &emsp;&ensp;:</label>
						<input type="text" id="j_peminjam" name="j_peminjam"><br><br>
						
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