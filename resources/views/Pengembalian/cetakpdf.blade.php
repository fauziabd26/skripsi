<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{asset('stisla')}}/img/polindra.png" type="image" sizes="16x16">
        <title>SILK &mdash; POLINDRA</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384=Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcjlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body style="background-color: white;">
        <style>
            table.static {
                position: relative;
                border: 1px solid #543535;
            }
            .line-tittle{
                border: 0;
                border-style: inset;
                border-top: 1px solid #000;
            }
        </style>
        @if (count($pengembalian))
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <table style="width: 100%;">
                        <tr>
                            <td align="center">
                                <span>
                                    SISTEM INFORMASI LABORATORIUM KEPERAWATAN 
                                    <br>POLITEKNIK NEGERI INDRAMAYU
                                </span>
                            </td>
                        </tr>
                    </table>
                    <hr class="line-title">
                        <p align="center">
                            Laporan Data Pengembalian Barang
                        </p>
                        <p align="center">
                            Periode <b>{{ date('d F Y', strtotime($tglawal)) }} s/d {{ date('d F Y', strtotime($tglakhir)) }}</b>
                        </p>
                    </hr>
                    <table id="example1" class="table table-bordered table-hover">
                            <thead class="thead-dark" align="center">
								<tr>
									<th>NO</th>
									<th>Nama Peminjam</th>
									<th>Nim Peminjam</th>
									<th>Kelas Peminjam</th>
									<th>Jumlah Peminjaman</th>
									<th>Jumlah Pengembalian</th>
									<th>Kondisi Barang</th>
									<th>Barang Dikembalikan</th>
									<th>Tanggal Pengembalian</th>
								</tr>
							</thead>
                         <?php 
							$no = 1;
						?>
                        @foreach($pengembalian as $b)
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
							<td align="center">
								@foreach($peminjaman as $p)
									@foreach($peminjamanbarang as $bp)
										@foreach($barang as $ba)
											<?php if ($b->id_Peminjaman == $p->id && $p->kode_barang_peminjaman == $bp->kode && $bp->id_barang == $ba->id) { ?>
												{{ $ba->name }} Jumlah {{ $bp->jumlah }}.
											<?php } ?>
										@endforeach
									@endforeach
								@endforeach
							</td>
                            <td align="center">
								@foreach($peminjaman as $p)
									@foreach($peminjamanbarang as $bp)
										@foreach($barang as $ba)
											<?php if ($b->id_Peminjaman == $p->id && $p->kode_barang_peminjaman == $bp->kode && $bp->id_barang == $ba->id) { ?>
												@foreach($pengembalianbarang as $pb )
													<?php if ($pb->id_barang == $bp->id_barang && $pb->peminjaman_id == $p->id) { ?>
														{{ $ba->name }} Jumlah {{ $pb->jumlah }}.
													<?php } ?>
												@endforeach
											<?php } ?>
										@endforeach
									@endforeach
								@endforeach
							</td>
							<td align="center">{{ $b->id_kondisi }}</td>
							<td align="center">{{ $b->Dikembalikan }}</td>
							<td align="center">{{ $b->tanggal_pengembalian }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @else
                <b>Laporan Pengembalian Barang Periode {{ date('d F Y', strtotime($tglawal)) }} s/d {{ date('d F Y', strtotime($tglakhir)) }} Belum tersedia</b>        
                @endif
            </div>
        </div>
        <script type="text/javascript">
            document.tittle = window.parent.document.title = "Laporan Pengembalian {{ date('d F Y', strtotime($tglawal)) }} s/d {{ date('d F Y', strtotime($tglakhir)) }}"
            window.print();
        </script>
        <!-- Modal Import-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Data Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="import" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="file" name="file" class="form-control">
                                <button type="submit" class="btn btn-primary mb-1">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
