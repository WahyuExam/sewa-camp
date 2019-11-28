@extends('admin.layoutBukti')

@section('content')
    <div class="container">
        <table width="100%">
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

        <h5>Data Pelanggan</h5>
        <table class="table table-bordered">
            <tr>
                <td width="15%">ID Pelanggan</td>
                <td width="2%">:</td>
                <td>{{ $pinjams[0]->idPelanggan }}</td>
            </tr>

            <tr>
                <td>Nama Pelanggan</td>
                <td>:</td>
                <td>{{ $pinjams[0]->nmPelanggan }}</td>
            </tr>

            <tr>
                <td>No. Telpon</td>
                <td>:</td>
                <td>{{ $pinjams[0]->noTelpPel }}</td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $pinjams[0]->alamatPel }}</td>
            </tr>

            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $pinjams[0]->email }}</td>
            </tr>

            <tr>
                <td>Jaminan</td>
                <td>:</td>
                <td>{{ $pinjams[0]->ket }} [ {{ $pinjams[0]->noJaminan }} ]</td>
            </tr>
        </table>

       <h5>Detail Alat Yang Dikembalikan</h5>
        <table class="table table-striped table-hover">
            <th>No</th>
            <th>Kode Alat</th>
            <th>Nama Alat</th>
            <th>Jumlah Pinjam</th>
            <th>Jumlah Alat Baik</th>
            <th>Jumlag Alat Hilang/Rusak</th>

            @if ($rusak<>0)
                <th>Biaya Alat Hilang/Rusak (Rp)</th>    
                <th>Total Biaya Alat Hilang/Rusak (Rp)</th>
            @endif
    
            @if ($durasi > $pinjams[0]->lamaPinjam)
                <th>Biaya Denda (Rp)</th>    
                <th>Total Biaya Denda (Rp)</th>
            @endif

           
            @foreach($pinjams as $no=>$pinjam)
                <tr>
                    <td width="5%">{{ ++$no }}</td>
                    <td>{{ $pinjam->kdAlat }}</td>
                    <td>{{ $pinjam->nmAlat }}</td>
                    <td>{{ $pinjam->jml }}</td>
                    <td>{{ $pinjam->jmlBaik }}</td>
                    <td>{{ $pinjam->jmlRusak }}</td>

                    @if ($rusak<>0)
                        <td>{{ number_format($pinjam->biayaAlatRusak) }}</td>
                        <td>{{ number_format($pinjam->ttlDendaHilang) }}</td>
                    @endif  

                    @if ($durasi > $pinjams[0]->lamaPinjam)
                        <td>{{ number_format($pinjam->biayaDenda) }}</td>
                        <td>{{ number_format($pinjam->ttlDenda) }}</td>
                    @endif     
                </tr>
            @endforeach
        </table>

        <table class="table table-striped">
            <tr>
                <td colspan="2" align="left" width="40%">Total Item</td>
                <td colspan="2">: {{ $item }}</td>
            </tr>

            <tr>
                <td colspan="2" align="left" width="40%">Lama Peminjaman</td>
                <td colspan="2">: {{ $pinjams[0]->lamaPinjam}} Hari</td>
            </tr>

            <tr>
                <td colspan="2" align="left" width="40%">Durasi Pinjam</td>
                <td colspan="2">: {{ $durasi }} Hari</td>
            </tr>

            @if ($durasi > $pinjams[0]->lamaPinjam)
                <tr>
                    <td colspan="2" align="left" width="40%">Telat</td>

                    <td colspan="2">: {{ $lamaDenda }} Hari</td>
                </tr>

                <tr>
                    <td colspan="2" align="left" width="40%">Besar Denda (Rp)</td>
                    <td colspan="2">: {{ number_format($ttlDenda) }}</td>
                </tr>
            @endif

            @if ($rusak<>0)
                <tr>
                    <td colspan="2" align="left" width="40%">Denda Barang Hilang/Rusak (Rp)</td>
                    <td colspan="2">: {{ number_format($rusak) }}</td>
                </tr>
            @endif

            <tr>
                <td colspan="2" align="left" width="40%">Total Bayar (Rp)</td>
                <td colspan="2">: {{ number_format($totalBayar) }}</td>
            </tr>

        </table>
           
        <p>*bukti ini harap disimpan</p>
    </div> <!-- end container -->
@endsection

@section('footer')
    <script>
    window.onload = window.print();
    window.close();
    </script>
@endsection