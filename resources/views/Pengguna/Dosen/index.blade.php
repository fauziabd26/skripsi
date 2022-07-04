@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Peminjaman</h1>
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
                                <th>Nama Peminjam</th>
                                <th>Tanggal Peminjaman</th>
								<th>Waktu Peminjaman</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php 
							$no = 1;
						?>
                        @foreach($data as $p)
							<?php if (Auth::user()->id == $p->id_dosen ) { ?>
							
								<tr>
									<td align="center">{{ $no++ }}</td>
								@foreach($mahasiswa as $m)
								<?php if ($m->Mahasiswa_id == $p->id_Mahasiswa) { ?>
									<td align="center">{{ $m->name }}</td>
								<?php } ?>
								@endforeach
									<td align="center">{{ $p->tanggal_peminjaman }}</td>
									<td align="center">{{ $p->waktu_peminjaman }}</td>
									<td align="center">
										<button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat<?php echo $p['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Lihat</i></button>
										<button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-pinjam<?php echo $p['id']; ?>"><i class="fa fa-check" aria-hidden="true"> Setuju</i></button>
										<a href="/PenggunaDosen/delete/{{$p->id}}" onclick="return confirm('Apakah Anda Yakin Tidak Menyetujui Data Ini?');" class="btn btn-danger btn-sm"><i class="fa fa-ban">Tidak</i></a>
									</td>
								</tr>
							<?php } ?>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal Lihat -->
<?php if (!empty($data)) { ?>
    <?php foreach ($data as $p) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-lihat<?php echo $p['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Peminjaman </h5>
                    </div>
                    <div class="modal-body">
						<div class="container-fluid">
						@foreach($peminjaman as $bp)
						@foreach($barang as $b)
							<?php if ($p->kode_barang_peminjaman == $bp->kode && $bp->id_barang == $b->id) { ?>
                            <div class="row">
                                <div class="col-md-4">Nama Barang</div>
                                <div class="col-md-6 ms-auto">{{ $b->name }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">Jumlah Peminjaman</div>
                                <div class="col-md-6 ms-auto">{{ $bp->jumlah }}</div>
                            </div><br>
							<?php } ?>
                        @endforeach
                        @endforeach
						@foreach($mahasiswa as $m)
						<?php if ($m->Mahasiswa_id == $p->id_Mahasiswa) { ?>
							<div class="row">
                                <div class="col-md-4">Nama Peminjam</div>
                                <div class="col-md-6 ms-auto">{{ $m->name }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">Nim</div>
                                <div class="col-md-6 ms-auto">{{ $m->nim }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">Kelas</div>
                                <div class="col-md-6 ms-auto">{{ $m->kelas }}</div>
                            </div><br>
						<?php } ?>
                        @endforeach
                            <div class="row">
                                <div class="col-md-4">Tanggal Peminjaman</div>
                                <div class="col-md-6 ms-auto">{{ $p->tanggal_peminjaman }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">waktu Peminjaman</div>
                                <div class="col-md-6 ms-auto">{{ $p->waktu_peminjaman }}</div>
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
    <?php foreach ($data as $p) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-pinjam<?php echo $p['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Peminjaman </h5>
                    </div>
					
						
					<form action="/PenggunaDosen/add/{{$p->id}}" method="POST">
						@csrf
                    <div class="modal-body">
						<div class="container-fluid">
							<input type="hidden" id="k_barang" name="k_barang" value="<?= $p['kode_barang_peminjaman'] ?>"readonly><br><br>
							@foreach($mahasiswa as $m)
						<?php if ($m->Mahasiswa_id == $p->id_Mahasiswa) { ?>
							<div class="row">
								<div class="col-md-4">Nama</div>
								<div class="col-md-6 ms-auto">
									<div class="col-md-4"><?= $m['name'] ?></div>
								</div>
								<div class="col-md-6 ms-auto">
									<input type="hidden" id="n_peminjam" name="n_peminjam" value="<?= $p['id_Mahasiswa'] ?>"readonly>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-4">Nim</div>
								<div class="col-md-6 ms-auto">
									<div class="col-md-4"><?= $m['nim'] ?></div>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-4">Kelas</div>
								<div class="col-md-6 ms-auto">
									<div class="col-md-4"><?= $m['kelas'] ?></div>
								</div>
							</div><br>
						<?php } ?>
                        @endforeach
									<input type="hidden" id="id_dosen" name="id_dosen" value="<?= $p['id_dosen'] ?>"readonly>
							<div class="row">
								<div class="col-md-4">Tanggal Peminjaman</div>
								<div class="col-md-6 ms-auto">
									<input type="date" id="t_peminjaman" name="t_peminjaman" value="<?= $p['tanggal_peminjaman'] ?>"readonly>
								</div>
							</div><br>
							
							<div class="row">
								<div class="col-md-4">waktu peminjaman</div>
								<div class="col-md-6 ms-auto">
									<input type="time" id="w_peminjaman" name="w_peminjaman" value="<?= $p['waktu_peminjaman'] ?>"readonly>
								</div>
							</div><br>
							
							<input type="hidden" id="aproval" name="aproval" value="ya"readonly>
							<input type="hidden" id="status" name="status" value="Dipinjam"readonly>
							
                        </div>
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