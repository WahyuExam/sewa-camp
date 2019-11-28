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
 
<center><h3>Laporan Alat</h3></center><hr>
<p>
    <a href="/admin/laporan/alat/preview" class="btn btn-primary" target="_blank" title="Preview">
      <span class="glyphicon glyphicon-print"> </span>
    </a>
              
  {{--   <a href="/admin/laporan/kriteria/excel" class="btn btn-primary" title="Print Excel">
      <span class="glyphicon glyphicon-print"> </span> 
    </a> --}}
</p>


<table class="table table-striped">
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

<div class="clearfix"></div>
@endsection