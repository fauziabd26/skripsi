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
        @if (count($peminjaman))
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
                            Laporan Data Peminjaman Barang
                        </p>
                        <p align="center">
                            Periode <b>{{ date('d F Y', strtotime($tglawal)) }} s/d {{ date('d F Y', strtotime($tglakhir)) }}</b>
                        </p>
                    </hr>
                    <table class="table table-bordered">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama Peminjam</th>
                                <th>Nim Peminjam</th>
                                <th>Kelas Peminjam</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Barang Diserahkan</th>
                                <th>Keterangan</th>
                                <th>Barang</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($peminjaman as $data)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
						@foreach($mahasiswa as $m)
						<?php if ($m->Mahasiswa_id == $data->nama_peminjam) { ?>
                            <td align="center">{{ $m->name }}</td>
                            <td align="center">{{ $m->nim }}</td>
                            <td align="center">{{ $m->kelas }}</td>
						<?php } ?>
						@endforeach
                            <td align="center">{{ $data->tanggal_peminjaman }}</td>
                            <td align="center">{{ $data->waktu_peminjaman }}</td>
                            <td align="center">{{ $data->status }}</td>
                            <td align="center">{{ $data->Diserahkan }}</td>
                            <td align="center">
							@foreach($barangP as $data1)
							@foreach($barang as $data2)
							<?php if ($data->kode_barang_peminjaman == $data1->kode && $data1->id_barang == $data2->id) {?>
								{{ $data2->name }} Jumlah
								{{ $data1->jumlah }}. 
							<?php } ?>
							@endforeach
							@endforeach
							</td>
                            <td align="center">{{ $data->Keterangan }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @else
                <b>Laporan Peminjaman Barang Periode {{ date('d F Y', strtotime($tglawal)) }} s/d {{ date('d F Y', strtotime($tglakhir)) }} Belum tersedia</b>        
                @endif
            </div>
        </div>
        <script type="text/javascript">
            document.tittle = window.parent.document.title = "Laporan Peminjaman {{ date('d F Y', strtotime($tglawal)) }} s/d {{ date('d F Y', strtotime($tglakhir)) }}"
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
