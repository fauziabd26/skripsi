@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Peminjaman</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Peminjaman</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
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
						@if ($message = Session::get('kosong'))
							<div class="alert alert-danger alert-block">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<strong>{{ $message }}</strong>
							</div>
						@endif
                        <a href="{{ route('tambah_Peminjaman') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Peminjaman
                        </a>&emsp;
                    </div>
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
                        <tr>
                            <td align="center">{{ $no++ }}</td>
						@foreach($mahasiswa as $m)
						<?php if ($m->Mahasiswa_id == $p->nama_peminjam) { ?>
                            <td align="center">{{ $m->name }}</td>
						<?php } ?>
                        @endforeach
							<td align="center">{{ $p->tanggal_peminjaman }}</td>
							<td align="center">{{ $p->waktu_peminjaman }}</td>
                            <td align="center">
                                <button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat<?php echo $p['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Lihat</i></button>
                                <a href="/Peminjaman/edit/{{$p->id}}" class="btn btn-warning btn-sm mr-2" title="Edit" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Edit</i></a>
                                <?php if ($p->Diserahkan != "Sudah") { ?>
									<a href="/Peminjaman/Serahkan/{{$p->id}}" class="btn btn-success btn-sm mr-2" title="Serahkan" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Diserahkan</i></a>
                                <?php } ?>
								<a href="/Peminjaman/delete/{{$p->id}}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
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
    <?php foreach ($data as $p) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-lihat<?php echo $p['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Peminjaman </h5>
                    </div>
                    <div class="modal-body">
						<div class="container-fluid">
						@foreach($mahasiswa as $m)
						<?php if ($m->Mahasiswa_id == $p->nama_peminjam) { ?>
							<div class="row">
                                <div class="col-md-4">Nama Peminjam</div>
                                <div class="col-md-6 ms-auto">{{ $m->name }}</div>
                            </div><br>
						<?php } ?>
                        @endforeach
						@foreach($dosen as $d)
						<?php if ($d->Dosen_id == $p->id_dosen) { ?>
							<div class="row">
                                <div class="col-md-4">Dosen</div>
                                <div class="col-md-6 ms-auto">{{ $d->name }}</div>
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
							<div class="row">
                                <div class="col-md-4">Aproval(Persetujuan)</div>
                                <div class="col-md-6 ms-auto">{{ $p->aprovals }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">Status</div>
                                <div class="col-md-6 ms-auto">{{ $p->status }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">Diserahkan</div>
                                <div class="col-md-6 ms-auto">{{ $p->Diserahkan }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">Keterangan</div>
                                <div class="col-md-6 ms-auto">{{ $p->Keterangan }}</div>
                            </div><br>
							
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <?php 
							$nobarang = 1;
						?>
						@foreach($peminjaman as $bp)
						@foreach($barang as $b)
							<?php if ($p->kode_barang_peminjaman == $bp->kode && $bp->id_barang == $b->id) { ?>
                        <tr>
                            <td align="center">{{ $nobarang++ }}</td>
                            <td align="center">{{ $b->name }}</td>
                            <td align="center">{{ $bp->jumlah }}</td>
                        </tr>
							<?php } ?>
                        @endforeach
                        @endforeach
                    </table>
						
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


@stop