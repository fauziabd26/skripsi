
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