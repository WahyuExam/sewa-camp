@extends('user.layoutUser')

@section('content')
    <div class="container">
        <table width="100%" >
            <tr>
                <td rowspan="4" align="center"><img src="{{ asset('/foto/logo.jpeg') }}" width="100px" height="100px"></td>
                <td align="center"><h4>CAMP OUTDOOR SERVICE AND RENT</h4></td>
            </tr>

            <tr>
                <td align="center">Jl.A.Yani Km.36 Gang.Purnama Ujung No.59 Rt.003 Rw.006 Kel.Komet Kec </td>
            </tr>
            
            <tr>
                <td align="center">Banjarbaru Utara,Kota Banjarbaru 70714</td>
            </tr>
            
            <tr>
                <td align="center">No. Telp : 085249652424/D39CDE09, Email : campoutdoorserviceandrent@yahoo.com <td>
            </tr>
        </table><hr>

        <div class="panel panel-primary">
            <div class="panel-heading"><h5>Data Pelanggan</h5></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <td width="15%">ID Pelanggan</td>
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
                            <td>{{ $keranjang->nmAlat }}</td>
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

        <div class="panel panel-primary">
            <div class="panel-heading">Cara Pemabayaran</div>
            <div class="panel-body">
                <p>Lakukan Transfer Uang Sesuai Nominal Yang Tertera Ke Rekening Berikut : </p>
                <p><strong>Nama Bank BRI</strong></p>
                <p><strong>No Rekening : 4510 - 0101 - 5671 - 534 a.n Nakir Muhajir</strong></p>
                <br>
                <p>Besar Nominal Yang Harus Dibayarkan <strong>Rp. {{number_format($keranjangs[0]->totalBayar) }}</strong></p>
            </div>
        </div>

        <p>*bukti ini harap disimpan dan Dibawa Saat Akan Mengambil Peralatan</p>
    </div> <!-- end container -->
@endsection

@section('footer')
    <script>
    window.onload = window.print();
    window.close();
    </script>
@endsection