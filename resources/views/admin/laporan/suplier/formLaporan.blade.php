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
 
<center><h3>Laporan Suplier</h3></center><hr>
<p>
    <a href="/admin/laporan/suplier/preview" class="btn btn-primary" target="_blank" title="Preview">
      <span class="glyphicon glyphicon-print"> </span>
    </a>
              
    {{-- <a href="/admin/laporan/kriteria/excel" class="btn btn-primary" title="Print Excel">
      <span class="glyphicon glyphicon-print"> </span> 
    </a> --}}
</p>


<table class="table table-striped">
    <th>No</th>
    <th>Kode Suplier</th>
    <th>Nama Suplier</th>
    <th>Alamat</th>
    <th>No. Telp</th>

    @foreach($supliers as $no=>$suplier)
        <tr>
            <td>{{ ++$no }}</td>
            <td>{{ $suplier->kdSuplier }}</td>
            <td>{{ $suplier->nmSuplier }}</td>
            <td>{{ $suplier->alamat }}</td>
            <td>{{ $suplier->noTelp }}</td>
        </tr>
    @endforeach 

</table>  

<div class="clearfix"></div>
@endsection