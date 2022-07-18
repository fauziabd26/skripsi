@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Pengembalian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Pengembalian</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
						@if ($message = Session::get('sukses'))
							<div class="alert alert-success alert-block">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
								<strong>{{ $message }}</strong>
							</div>
						@endif
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('tambah_Pengembalian') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Pengembalian
                        </a>
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
                                <th>Tanggal Pengembalian</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                         <?php 
							$no = 1;
						?>
                        @foreach($data as $b)
						
						@foreach($data2 as $d)
						@foreach($pengembalianbarang as $pb )
									<?php if ($pb->peminjaman_id == $b->id_Peminjaman && $d->peminjaman_id == $b->id_Peminjaman) { ?>
										<?php if ($d->jumlah != $pb->jumlah) { ?>
											<tr class="alert alert-danger">
										<?php } ?>
									<?php } ?>
						@endforeach
                        @endforeach
						
                            <td align="center">{{ $no++ }}</td>
						@foreach($mahasiswa as $m)
						@foreach($peminjaman1 as $p)
						<?php if ($m->Mahasiswa_id == $p->id_Mahasiswa && $b->id_Peminjaman == $p->id) { ?>
                            <td align="center">{{ $m->name }}</td>
                            <td align="center">{{ $m->nim }}</td>
                            <td align="center">{{ $m->kelas }}</td>
						<?php } ?>
                        @endforeach
                        @endforeach
							<td align="center">{{ $b->tanggal_pengembalian }}</td>
                            <td align="center">
                                <button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat<?php echo $b['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Lihat</i></button>
                                <button class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#modal-edit<?php echo $b['id']; ?>"><i class="fa fa-pen" aria-hidden="true"> Edit</i></button>
								<?php if ($b->Dikembalikan != "Sudah") { ?>
									<a href="/Pengembalian/Kembalikan/{{$b->id}}" class="btn btn-success btn-sm mr-2" title="Kembalikan" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Dikembalikan</i></a>
								<?php } ?>
								<a href="/Pengembalian/delete/{{$b->id}}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus data ini ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
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
                        <h5 class="modal-title">Data Pengembalian </h5>
					
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
						@foreach($mahasiswa as $m)
						@foreach($peminjaman1 as $p)
						<?php if ($m->Mahasiswa_id == $p->id_Mahasiswa && $b->id_Peminjaman == $p->id) { ?>
                            <div class="row">
                                <div class="col-md-4">Nama Peminjam</div>
                                <div class="col-md-6 ms-auto">{{ $m->name }}</div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">Nim Peminjam</div>
                                <div class="col-md-6 ms-auto">{{ $m->nim }}</div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">Kelas Peminjam</div>
                                <div class="col-md-6 ms-auto">{{ $m->kelas }}</div>
                            </div><br>
						<?php } ?>
                        @endforeach
                        @endforeach
							
                            <div class="row">
                                <div class="col-md-4">Tanggal Pengembalian</div>
                                <div class="col-md-6 ms-auto">{{ $b->tanggal_pengembalian }}</div>
                            </div><br>
							
						@foreach($peminjaman1 as $p)
						<?php if ($b->id_Peminjaman == $p->id) { ?>
                            <div class="row">
                                <div class="col-md-4">Tanggal Peminjaman</div>
                                <div class="col-md-6 ms-auto">{{ $p->tanggal_peminjaman }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">Waktu Peminjaman</div>
                                <div class="col-md-6 ms-auto">{{ $p->waktu_peminjaman }}</div>
                            </div><br>
						<?php } ?>
                        @endforeach
							
							<div class="row">
                                <div class="col-md-4">Kondisi</div>
                                <div class="col-md-6 ms-auto">{{ $b->id_kondisi }}</div>
                            </div><br>
							<div class="row">
                                <div class="col-md-4">Dikembalikan</div>
                                <div class="col-md-6 ms-auto">{{ $b->Dikembalikan }}</div>
                            </div><br>
							
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Dipinjam</th>
								<th>Jumlah Dikembalikan</th>
                            </tr>
                        </thead>
                        <?php 
							$nobarang = 1;
						?>
						@foreach($peminjaman1 as $p)
						@foreach($peminjamanbarang as $bp)
						@foreach($barang as $ba)
							<?php if ($b->id_Peminjaman == $p->id && $p->kode_barang_peminjaman == $bp->kode && $bp->id_barang == $ba->id) { ?>
								<tr>
									<td align="center">{{ $nobarang++ }}</td>
									<td align="center">{{ $ba->name }}</td>
									<td align="center">{{ $bp->jumlah }}</td>
									@foreach($pengembalianbarang as $pb )
										<?php if ($pb->id_barang == $bp->id_barang && $pb->peminjaman_id == $p->id) { ?>
											<td align="center">{{ $pb->jumlah }}</td>
										<?php } ?>
									@endforeach
								</tr>
							<?php } ?>
                        @endforeach
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


<!-- Modal edit -->
<?php if (!empty($data)) { ?>
    <?php foreach ($data as $b) : ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-edit<?php echo $b['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit </h5>
                    </div>
					
						
					<form action="/Pengembalian/update/{{ $b->id }}" method="POST">
                    @method('PUT')    
						@csrf
                    <div class="modal-body">
						<div class="container-fluid">
							
						@foreach($pengembalianbarang as $pb)
						@foreach($barang as $ba)
							<?php if ($b->kode_barang_pengembalian == $pb->kode && $pb->id_barang == $ba->id) { ?>
							<input type="hidden" id="b_pengembalian[]" name="b_pengembalian[]" value="{{ $pb->id }}"><br><br>
							<div class="row"> 
									<div class="col-md-4">{{ $ba->name }}</div>
									<div class="col-md-6 ms-auto">
										<input type="hidden" id="namaBarang[]" name="namaBarang[]" value="{{ $pb->id_barang }}">
									</div>
							</div><br>
							<div class="row">
									<div class="col-md-4">Jumlah Pengembalian</div>
									<div class="col-md-6 ms-auto">
										<input type="number" id="j_Pengembalian[]" name="j_Pengembalian[]" value="{{ $pb->jumlah }}">
									</div>
									<div class="text-danger">
										@error('j_Pengembalian')
											{{ $message }}
										@enderror
									</div>
							</div><br>
							<?php } ?>
                        @endforeach
                        @endforeach
							
							<div class="row">
									<div class="col-md-4">Tanggal Pengembalian</div>
									<div class="col-md-6 ms-auto">
										<input type="date" id="t_Pengembalian" name="t_Pengembalian" value="{{ $b->tanggal_pengembalian }}">
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
												<option value="{{ $b->idkondisi }}" selected> {{ $b->id_kondisi }} </option>
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
<!-- END Modal edit -->

@stop