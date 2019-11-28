@extends('admin/layoutAdmin')

@section('pemberitahuan')
  <li class="">
      <a href="/admin/pemberitahuan">
         <i class="fa fa-bell-o"   style="font-size:20px"></i>
         <span class="badge bg-red">{{ $jmlPemberitahuan[0]->jml }}</span>
    </a>           
  </li>
@endsection

@section('content')
<br><br><br>
 
<center><h4>Laporan Penggajihan Karyawan Bulan {{ $bln }} Tahun {{ $thn }}</h4></center>
<p>
    <a href="/admin/laporan/gaji/preview/{{ $bulan }}" class="btn btn-primary" target="_blank" title="Preview">
      <span class="glyphicon glyphicon-print"> </span>
    </a>

    <a href="/admin/laporan/gaji/form" class="btn btn-default">Kembali</a>
</p>

 <table class="table table-striped">
    <th>No</th>
    <th>Tanggal Penggajihan</th>
    <th>ID Karyawan</th>
    <th>Nama Karyawan</th>
    <th>Besar Gaji</th>

    @foreach($lists as $no=>$list)
        <tr> 
            <td>{{ ++$no }}</td>
            <td>{{ date('d - m - Y', strtotime($list->tglGaji)) }}</td>
            <td>{{ $list->idKaryawan }}</td>
            <td>{{ $list->nmKaryawan }}</td>
            <td>Rp.{{ number_format($list->gaji) }}</td>
        </tr>
    @endforeach

    <tr>
        <td colspan="4" align="right">Total Penggajihan</td>
        <td colspan="2">Rp.{{ number_format($total) }}</td>
    </tr>
   
</table>    

<div class="clearfix"></div>
@endsection