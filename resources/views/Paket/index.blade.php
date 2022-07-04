@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Paket Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Paket Barang</div>
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
                    <div class="col">
                        <a href="{{ route('create_Paket') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Paket Barang
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
								<th>Nama Paket</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
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
                            <td align="center">{{ $b->keterangan }}</td>
                            <td align="center">
                                <button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat<?php echo $b['id']; ?>"><i class="fa fa-eye" aria-hidden="true"> Lihat</i></button>
                                <a href="/paket/edit/{{$b->id}}" class="btn btn-warning btn-sm mr-2" title="Edit" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Edit</i></a>
                                <a href="/paket/delete/{{$b->id}}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
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
                        <h5 class="modal-title">Data Paket </h5>
                    </div>
                    <div class="modal-body">
						<div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">Kode Paket</div>
                                <div class="col-md-4 ms-auto"><?= $b['id'] ?></div>
                            </div><br>
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
                                <div class="col-md-6 ms-auto"><?= $ba['name'] ?> jumlah <?= $pb['jumlah'] ?></div>
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


@stop