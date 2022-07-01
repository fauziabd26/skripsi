<table id="example1" class="table table-bordered table-hover">
						<thead class="thead-dark" align="center">
                                <tr>
                                <th>NO</th>
                                <th>Nama Paket</th>
                                <th>Nama Peminjam</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($peminjaman as $data)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
							@foreach($paket as $p)
							<?php if ($data->kode_paket == $p->id) { ?>
                            <td align="center">{{ $p->nama }}</td>
							<?php } ?>
							@endforeach
                            <td align="center">{{ $data->nama_peminjam }}</td>
                            <td align="center">{{ $data->jumlah_peminjaman }}</td>
                            <td align="center">{{ $data->tanggal_peminjaman }}</td>
                            <td align="center">{{ $data->waktu_peminjaman }}</td>
                        </tr>
                        @endforeach
</table>