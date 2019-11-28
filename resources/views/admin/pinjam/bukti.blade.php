@extends('admin.layoutBukti')

@section('content')

    <a href="/admin/pinjam/bukti/{{ $keranjangs[0]->pinjamId}}/preview" class="btn btn-primary" target="_blank" title="Preview">
            <span class="glyphicon glyphicon-print"> </span>
    </a>
                        
    <a href="/admin/pinjam/list/{{ date('Y-m-d') }}" class="btn btn-danger">Kembali Ke Menu Utama</a>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"><h5>Data Pelanggan</h5></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <td width="10%">ID Pelanggan</td>
                        <td width="2%">:</td>
                        <td>{{ $keranjangs[0]->idPelanggan }}</td>
                    </tr>

                    <tr>
                        <td>Nama Pelanggan</td>
                        <td>:</td>
                        <td>{{ $keranjangs[0]->nmPelanggan }}</td>
                    </tr>

                    <tr>
                        <td>No. Telpon</td>
                        <td>:</td>
                        <td>{{ $keranjangs[0]->noTelpPel }}</td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $keranjangs[0]->alamatPel }}</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $keranjangs[0]->email }}</td>
                    </tr>

                    <tr>
                        <td>Jaminan</td>
                        <td>:</td>
                        <td>{{ $keranjangs[0]->ket }} [ {{ $keranjangs[0]->noJaminan }} ]</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading"><h5>Detail Alat Yang Dipinjam</h5></div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <th>No</th>
                    <th>Kode Alat</th>
                    <th>Nama Alat</th>
                    <th>Biaya Sewa</th>
                    <th>Jumlah Pinjam</th>
                    <th>Total Biaya Pinjam</th>
                    
                    @foreach($keranjangs as $no=>$keranjang)
                        <tr>
                            <td width="5%">{{ ++$no }}</td>
                            <td>{{ $keranjang->kdAlat }}</td>
                            <td width="45%">{{ $keranjang->nmAlat }}</td>
                            <td>{{ number_format($keranjang->biayaSewa) }}</td>
                            <td>{{ $keranjang->jml }}</td>
                            <td>{{ number_format($keranjang->ttlBiaya) }}</td>        
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="right">Total Item</td>
                        <td colspan="2">{{ $item }}</td>
                    </tr>

                    <tr>
                        <td colspan="5" align="right">Lama Peminjaman (Hari)</td>
                        <td colspan="2">{{ $keranjangs[0]->lamaPinjam}}</td>
                    </tr>

                    <tr>
                        <td colspan="5" align="right">Grand Total Biaya (Rp)</td>
                        <td colspan="2">{{ number_format($keranjangs[0]->totalBayar) }}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div> <!-- end container -->
@endsection