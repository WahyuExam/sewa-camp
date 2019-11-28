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
    <center><h4>Laporan Peralatan</h4></center>

    <table class="table table-bordered">
        <th>No</th>
        <th>Kode ALat</th>
        <th>Nama Alat</th>
        <th>Merk Alat</th>
        <th>Deskripsi Alat</th>
        <th>Jumlah Stok</th>

        @foreach($alats as $no=>$alat)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $alat->kdAlat }}</td>
                <td>{{ $alat->nmAlat }}</td>
                <td>{{ $alat->merkAlat }}</td>
                <td>{{ $alat->ketAlat }}</td>
                <td>{{ $alat->stok=='' ? '0' : $alat->stok }}</td>
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