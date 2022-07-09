@extends('layouts.main')

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
						<a href="{{ route('index_paket_pengguna') }}" class="btn btn-primary" title="Paket Barang" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Peminjaman Paket Barang
                        </a>&emsp;
						<a href="{{ route('create_Peminjaman') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Peminjaman
                        </a>
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
                    </div>
                    <div class="modal-body">
						<div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">Nama Barang</div>
                                <div class="col-md-6 ms-auto"><?= $b['name'] ?></div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">Stok Barang</div>
                                <div class="col-md-6 ms-auto"><?= $b['stok'] ?></div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">Kategori Barang</div>
                                <div class="col-md-6 ms-auto"><?= $b['k_name'] ?></div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">Satuan Barang</div>
                                <div class="col-md-6 ms-auto"><?= $b['s_name'] ?></div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">Gambar Barang</div>
                                <div class="col-md-6 ms-auto"><img src="{{ url('img/barang/'.$b->file) }}" width="150px" alt=""></div>
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
<?php if (!empty($barang)) { ?>
    <?php foreach ($barang as $b) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-pinjam<?php echo $b['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Peminjaman </h5>
                    </div>
					
						
					<form action="/PenggunaMahasiswa/add/{{$b->id}}" method="POST">
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