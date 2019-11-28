@extends('admin/layoutLaporan')

@section('content')
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
    <center><h4>Laporan Pengembalian Perdetail</h4></center>
    {{-- {{dd($listDetail)}} --}}
    Kode Pengembalian : {{ $listDetail[0]->kdKembali }}<br>
    Tanggal Pengembalian : {{ date('d - m - Y', strtotime($listDetail[0]->tglkembali)) }}<br>
    Nama Pelanggan / Petugas : {{ $listDetail[0]->nmPelanggan }} / {{ $listDetail[0]->nmKaryawan }}<br><br>

    Detail Pengembalian : 
    <table class="table table-striped">
        <th>No</th>
        <th>Kode Alat</th>
        <th>Alat</th>
        <th>Jumlah Pinjam</th>
        <th>Jumlah Alat Baik</th>
        <th>Jumlah Alat Rusak</th>


        @foreach($listDetail as $no=>$detail)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $detail->kdAlat }}</td>
                    <td>{{ $detail->nmAlat }}</td>
                    <td>{{ $detail->jml }}</td>
                    <td>{{ $detail->jmlBaik }}</td>
                    <td>{{ $detail->jmlRusak }}</td>
                </tr>
        @endforeach
    </table>    

    <table width="35%">
        <tr>
            <td colspan="1" align="left"><strong>Lama Telat (Hari)</strong></td>
            <td>:</td>
            <td><strong>{{ $listDetail[0]->durasi }}</strong></td>
        </tr>

        <tr>
            <td colspan="1" align="left"><strong>Denda Telat</strong></td>
            <td>:</td>
            <td><strong>Rp. {{ number_format($listDetail[0]->denda) }}</strong></td>
        </tr>

        <tr>
            <td colspan="1" align="left"><strong>Denda Alat Rusak</strong></td>
            <td>:</td>
            <td><strong>Rp. {{ number_format($listDetail[0]->dendaHilang) }}</strong></td>
        </tr>

        <tr>
            <td colspan="1" align="left"><strong>Total Denda</strong></td>
            <td>:</td>
            <td><strong>Rp. {{ number_format($listDetail[0]->denda + $listDetail[0] ->dendaHilang) }}</strong></td>
        </tr>
        
    </table>


    <div class="pull-right">
        <p>Banjarbaru, {{ tglIndo(date("d-m-Y"),'2') }}</p>
        <p>Mengetahui,</p>
    </div>
@endsection

@section('footer')
    <script>
    window.onload = window.print();
    window.close();
    </script>
@endsection