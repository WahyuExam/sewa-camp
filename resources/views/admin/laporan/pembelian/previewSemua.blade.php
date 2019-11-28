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
    <center><h4>Laporan Pembelian Peralatan Bulan {{ $bln }} Tahun {{ $thn }}</h4></center>

  <table class="table table-striped">
        <th>No</th>
        <th>Kode Pembelian</th>
        <th>tanggal Pembelian</th>
        <th>Suplier</th>
        <th>Total Pembelian</th>
        
        @foreach($lists as $no=>$list)
            <tr> 
                <td>{{ ++$no }}</td>
                <td>{{ $list->kdBeli }}</td>
                <td>{{ date('d - m  - Y',strtotime($list->tglBeli)) }}</td>
                <td>{{ $list->nmSuplier}}</td>
                <td>Rp. {{ number_format($list->ttlBeli) }}</td>
            </tr>
        @endforeach
        
        <tr>
            <td colspan="4" align="right">Total Pembelian</td>
            <td colspan="2">Rp.{{number_format($total)}}</td>
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