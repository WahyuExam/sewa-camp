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
 
<center><h3>Laporan Pelanggan</h3></center><hr>
<p>
    <a href="/admin/laporan/pelanggan/preview" class="btn btn-primary" target="_blank" title="Preview">
      <span class="glyphicon glyphicon-print"> </span>
    </a>
              
    {{-- <a href="/admin/laporan/kriteria/excel" class="btn btn-primary" title="Print Excel">
      <span class="glyphicon glyphicon-print"> </span> 
    </a> --}}
</p>


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

<div class="clearfix"></div>
@endsection