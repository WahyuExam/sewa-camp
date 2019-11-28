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
    <center><h4>Laporan Pelanggan</h4></center>

    <table class="table table-striped table-hover">
        <th>No</th>
        <th>ID Pelanggan</th>
        <th>Nama Pelanggan</th>
        <th>No Telp Pelanggan</th>
        <th>Email</th>
        <th>Alamat Pelanggan</th>
        <th>Status Pelanggan</th>

        @foreach($pelanggans as $no=>$pelanggan)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $pelanggan->idPelanggan }}</td>
                <td>{{ $pelanggan->nmPelanggan }}</td>
                <td>{{ $pelanggan->noTelpPel }}</td>
                <td>{{ $pelanggan->email }}</td>
                <td>{{ $pelanggan->alamatPel }}</td>
                <td>{{ $pelanggan->statusPelanggan=='1' ? 'Online' : 'Offline' }}</td>
            </tr>
        @endforeach
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