@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ route('index_laporan_barang') }}"><h1>Laporan Data Pengembalian</h1></a>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Laporan Pengembalian</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalPdf">
                            <i class="fas fa-print mr-2"></i>Export PDF
                        </button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExcel">
                            <i class="fas fa-print mr-2"></i>Export EXCEL
                        </button>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> {{ session('error') }}.
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    @if (count($peminjaman))
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                            <thead class="thead-dark" align="center">
								<tr>
									<th>NO</th>
									<th>Nama Peminjam</th>
									<th>Nim Peminjam</th>
									<th>Kelas Peminjam</th>
									<th>Jumlah Pengembalian</th>
									<th>Tanggal Pengembalian</th>
									<th>Nama Barang</th>
									<th>Kondisi Barang</th>
								</tr>
							</thead>
                         <?php 
							$no = 1;
						?>
                        @foreach($data as $b)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
						@foreach($mahasiswa as $m)
						@foreach($peminjaman as $p)
						<?php if ($m->Mahasiswa_id == $p->id_Mahasiswa && $b->id_Peminjaman == $p->id) { ?>
                            <td align="center">{{ $m->name }}</td>
                            <td align="center">{{ $m->nim }}</td>
                            <td align="center">{{ $m->kelas }}</td>
						<?php } ?>
                        @endforeach
                        @endforeach
                            <td align="center">{{ $b->jumlah_pengembalian }}</td>
							<td align="center">{{ $b->tanggal_pengembalian }}</td>
							<td align="center">
						@foreach($peminjaman as $p)
						@foreach($peminjamanbarang as $bp)
						@foreach($barang as $ba)
							<?php if ($b->id_Peminjaman == $p->id && $p->kode_barang_peminjaman == $bp->kode && $bp->id_barang == $ba->id) { ?>
                                {{ $ba->name }} 
							<?php } ?>
                        @endforeach
                        @endforeach
                        @endforeach
							<td align="center">{{ $b->id_kondisi }}</td>
							</td>
                        </tr>
                        @endforeach
                    </table>
                    
                    <br>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col">
                            <div class="alert alert-primary">
                                <i class="fa fa-exclamation-triangle"></i> Data Pengembalian Belum tersedia
                            </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
    
    <!-- Modal Print PDF -->
<div class="modal fade" id="modalPdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/laporan_pdf_Pengembalian" method="POST" target="_blank">
                @csrf           
                <div class="card-header">
                    <div class="form-group mr-3">
                        <label for="label">Tanggal Awal</label>
                        <input type="date" name="tglawal" id="tglawal" class="form-control @error('tglawal') is-invalid @enderror" required>
                        @error('tglawal')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mr-3">
                        <label for="label">Tanggal Akhir</label>
                        <input type="date" name="tglakhir" id="tglakhir" class="form-control @error('tglakhir') is-invalid @enderror" required>
                        @error('tglakhir')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger mb-1">
                        <span class="icon text-white-50">
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">
                            Cetak PDF
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Print Excel-->
<div class="modal fade" id="modalExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/laporan_excel_Pengembalian" method="GET">
            @csrf           
            <div class="modal-content">
                <div class="card-header">
                    <div class="form-group mr-3">
                        <label for="label">Tanggal Awal</label>
                        <input type="date" name="tglawal" id="tglawal" class="form-control @error('tglawal') is-invalid @enderror" required>
                        @error('tglawal')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mr-3">
                        <label for="label">Tanggal Akhir</label>
                        <input type="date" name="tglakhir" id="tglakhir" class="form-control @error('tglakhir') is-invalid @enderror" required>
                        @error('tglakhir')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success mb-1">
                        <span class="icon text-white-50">
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">
                            Cetak Excel
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@stop