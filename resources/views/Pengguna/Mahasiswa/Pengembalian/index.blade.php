@extends('layoutMahasiswa.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Pengembalian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Pengembalian</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="#" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Pengembalian
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
								<th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Nama Peminjam</th>
                                <th>Jumlah Peminjam</th>
								<th>Tanggal Peminjaman</th>
								<th>Waktu Peminjaman</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                         <?php 
							$no = 1;
						?>
                        @foreach($data as $b)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ $b->kode_barang }}</td>
                            <td align="center">{{ $b->nama_barang }}</td>
                            <td align="center">{{ $b->nama_peminjam }}</td>
                            <td align="center">{{ $b->jumlah_peminjam }}</td>
							<td align="center">{{ $b->tanggal_peminjaman }}</td>
							<td align="center">{{ $b->waktu_peminjaman }}</td>
                            <td align="center">
                                <button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat<?php echo $b['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Lihat</i></button>
								<button class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#modal-kembalikan<?php echo $b['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Kembalikan</i></button>
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
                        <h5 class="modal-title">Data Barang </h5>
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
						<p>Jumlah Peminjaman  		&emsp;&emsp;: {{ $b->jumlah_peminjam }}</p>
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
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-kembalikan<?php echo $b['id']; ?>" class="modal fade">
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
						<label>Nama Barang		&emsp;&emsp;&emsp;&emsp;:</label>
						<input type="text" id="n_barang" name="n_barang" value="<?= $b['nama_barang'] ?>"readonly><br><br>
						
						<label>Nama Peminjam	&emsp;&emsp;&emsp;:</label>
						<input type="text" id="n_peminjam" name="n_peminjam" value="<?= $b['nama_peminjam'] ?>"readonly><br><br>
						
						<label>Jumlah Pengembalian &emsp;:</label>
						<input type="text" id="j_peminjam" name="j_peminjam"><br><br>
						
						<label>Tanggal Peminjaman	&emsp;&ensp;:</label>
						<input type="date" id="t_peminjaman" name="t_peminjaman" value="<?= $b['tanggal_peminjaman'] ?>"readonly><br><br>
						
						<label>waktu peminjaman	&ensp;&emsp;&emsp;:</label>
						<input type="time" id="w_peminjaman" name="w_peminjaman" value="<?= $b['waktu_peminjaman'] ?>"readonly><br><br>
						
						<label>Tanggal Pengembalian	&ensp;:</label>
						<input type="date" id="t_peminjaman" name="t_peminjaman"><br><br>
						
						<label>Kondisi &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;:</label>
						<input type="text" id="j_peminjam" name="j_peminjam"><br><br>
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