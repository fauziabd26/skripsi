<table id="example1" class="table table-bordered table-hover">
    <thead class="thead-dark" align="center">
        <tr>
            <th>NO</th>
            <th>Nama Barang</th>
            <th>stok</th>
            <th>Kategori Barang</th>
            <th>Satuan Barang</th>
        </tr>
    </thead>
    <?php $no = 1;?>
    @foreach($barang as $data)
        <tr>
            <td align="center">{{ $no++ }}</td>
            <td align="center">{{ $data->name }}</td>
            <td align="center">{{ $data->stok }}</td>
            <td align="center">{{ !empty($data->kategori) ? $data->kategori->name:'' }}</td>
            <td align="center">{{ !empty($data->satuan) ? $data->satuan->name:'' }}</td>
        </tr>
    @endforeach
</table>