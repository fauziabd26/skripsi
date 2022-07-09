@extends('layouts.main')

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
                    @if ($message = Session::get('sukses'))
							<div class="alert alert-success alert-block">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<strong>{{ $message }}</strong>
							</div>
						@endif
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama Peminjam</th>
                                <th>Nim Peminjam</th>
                                <th>Kelas Peminjam</th>
								<th>Tanggal Peminjaman</th>
								<th>Waktu Peminjaman</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                         <?php 
							$no = 1;
						?>
                        @foreach($data as $b)
						<?php if (Auth::user()->id == $b->id_Mahasiswa && $b->status == "Dipinjam") { ?>
                        <tr>
                            <td align="center">{{ $no++ }}</td>
						@foreach($mahasiswa as $m)
						<?php if ($m->Mahasiswa_id == $b->id_Mahasiswa) { ?>
                            <td align="center">{{ $m->name }}</td>
                            <td align="center">{{ $m->nim }}</td>
                            <td align="center">{{ $m->kelas }}</td>
						<?php } ?>
                        @endforeach
							<td align="center">{{ $b->tanggal_peminjaman }}</td>
							<td align="center">{{ $b->waktu_peminjaman }}</td>
                            <td align="center">
                                <button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat<?php echo $b['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Lihat</i></button>
								<button class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#modal-kembalikan<?php echo $b['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Kembalikan</i></button>
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
    <?php foreach ($data as $b) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-lihat<?php echo $b['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Barang </h5>
                    </div>
                   <div class="modal-body">
						<div class="container-fluid">
						@foreach($peminjaman as $bp)
						@foreach($barang as $ba)
							<?php if ($b->kode_barang_peminjaman == $bp->kode && $bp->id_barang == $ba->id) { ?>
                            <div class="row">
                                <div class="col-md-4">Barang</div>
                                <div class="col-md-6 ms-auto">{{ $ba->name }} Jumlah {{ $bp->jumlah }}</div>
                            </div><br>
							<?php } ?>
                        @endforeach
                        @endforeach
						@foreach($mahasiswa as $m)
						<?php if ($m->Mahasiswa_id == $b->id_Mahasiswa) { ?>
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
                                <div class="col-md-6 ms-auto">{{ $b->tanggal_peminjaman }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">waktu Peminjaman</div>
                                <div class="col-md-6 ms-auto">{{ $b->waktu_peminjaman }}</div>
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
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-kembalikan<?php echo $b['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pengembalian </h5>
                    </div>
					
						
					<form action="/PenggunaMahasiswaPengembalian/add" method="POST">
						@csrf
                    <div class="modal-body">
						<div class="container-fluid">
							<input type="hidden" id="n_peminjam" name="n_peminjam" value="<?= $b['id'] ?>"readonly><br><br>
							
							<div class="row">
									<div class="col-md-4">Jumlah Pengembalian</div>
									<div class="col-md-6 ms-auto">
										<input type="number" id="j_Pengembalian" name="j_Pengembalian">
									</div>
									<div class="text-danger">
										@error('j_Pengembalian')
											{{ $message }}
										@enderror
									</div>
							</div><br>
							
							<div class="row">
									<div class="col-md-4">Tanggal Pengembalian</div>
									<div class="col-md-6 ms-auto">
										<input type="date" id="t_Pengembalian" name="t_Pengembalian">
									</div>
									<div class="text-danger">
										@error('t_Pengembalian')
											{{ $message }}
										@enderror
									</div>
							</div><br>
							
							<div class="row">
									<div class="col-md-4">Kondisi</div>
									<div class="col-md-6 ms-auto">
										<select class="form-control" name="kondisi" id="kondisi">
												<option disabled selected> Pilih Kondisi </option>
											@foreach($data1 as $k)
												<option value="{{ $k->id }}"> {{ $k->name }} </option>
											@endforeach
										</select>
									</div>
									<div class="text-danger">
										@error('kondisi')
											{{ $message }}
										@enderror
									</div>
							</div><br>
                            
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
