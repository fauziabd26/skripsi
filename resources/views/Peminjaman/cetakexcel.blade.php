<table id="example1" class="table table-bordered table-hover">
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
                                <th>Barang</th>
                                <th>Keterangan</th>
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