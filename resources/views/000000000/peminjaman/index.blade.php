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
                        <a href="{{ route('tambah_Peminjaman') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Peminjaman
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
                                <th>Jumlah Peminjaman</th>
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
                                <a href="/Peminjaman/edit/{{$b->id}}" class="btn btn-warning btn-sm mr-2" title="Edit" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Edit</i></a>
                                <a href="/Peminjaman/delete/{{$b->id}}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
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
						<p>Jumlah Peminjaman  		&emsp;&emsp;: {{ $b->jumlah_peminjam }}</p>
						<p>Tanggal Peminjaman  		&emsp;&ensp;: {{ $b->tanggal_peminjaman }}</p>
						<p>waktu Peminjaman  		&emsp;&emsp;: {{ $b->waktu_peminjaman }}</p>
						<p>Aproval(Persetujuan)  	&emsp;: {{ $b->aprovals }}</p>
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