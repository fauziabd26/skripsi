<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            table.static {
                position: relative;
                border: 1px solid #543535;
            }
        </style>
        <link rel="icon" href="{{asset('stisla')}}/img/polindra.png" type="image" sizes="16x16">
        <title>SILK &mdash; POLINDRA</title>
    </head>
    <body>

        <div class="table-responsive">
            <p align="center">Laporan Barang</p>
            <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
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
                    <td align="center">{{ $data->kategori->name }}</td>
                    <td align="center">{{ $data->satuan->name }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    <script type="text/javascript">
        document.tittle = window.parent.document.title = "Laporan Barang"
        window.print();
    </script>
</body>
</html>
