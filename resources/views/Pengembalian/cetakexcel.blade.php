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
                        <?php $no = 1;?>
                        @foreach($pengembalian as $data)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
						@foreach($mahasiswa as $m)
						@foreach($peminjaman as $p)
						<?php if ($m->Mahasiswa_id == $p->id_Mahasiswa && $data->id_Peminjaman == $p->id) { ?>
                            <td align="center">{{ $m->name }}</td>
                            <td align="center">{{ $m->nim }}</td>
                            <td align="center">{{ $m->kelas }}</td>
						<?php } ?>
						@endforeach
						@endforeach
                            <td align="center">{{ $data->jumlah_pengembalian }}</td>
                            <td align="center">{{ $data->tanggal_pengembalian }}</td>
                            <td align="center">
							@foreach($peminjaman as $p)
							@foreach($peminjamanbarang as $bp)
							@foreach($barang as $ba)
							<?php if ($data->id_Peminjaman == $p->id && $p->kode_barang_peminjaman == $bp->kode && $bp->id_barang == $ba->id) { ?>
								{{ $ba->name }} 
							<?php } ?>
							@endforeach
							@endforeach
							@endforeach
							</td>
							<td align="center">{{ $data->id_kondisi }}</td>
                        </tr>
                        @endforeach
</table>