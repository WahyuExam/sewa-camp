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
    <center><h4>Laporan Pembelian Perdetail</h4></center>

    Kode Pembelian : {{ $dataBeli->kdBeli }}<br>
    Tanggal Pembelian : {{ date('d - m - Y', strtotime($dataBeli->tglBeli)) }} <br><br>
    Detail Pembelian :

    <table class="table table-striped">
        <th>No</th>
        <th>Kode Alat</th>
        <th>Alat</th>
        <th>Jumlah Beli</th>
        <th>Harga Beli</th>
        <th>Total</th>

        @foreach($listDetail as $no=>$detail)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $detail->kdAlat }}</td>
                    <td>{{ $detail->nmAlat }}</td>
                    <td>{{ $detail->jmlBeli }}</td>
                    <td>Rp. {{ number_format($detail->hargaBeli) }}</td>
                    <td>Rp. {{ number_format($detail->sub) }}</td>
                </tr>
        @endforeach

        <tr>
            <td></td>
            <td colspan="4" align="right"><strong>Grand Total</strong></td>
            <td><strong>Rp. {{ number_format($total) }}</strong></td>
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