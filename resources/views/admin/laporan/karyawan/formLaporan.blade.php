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
 
<center><h3>Laporan Karyawan</h3></center><hr>
<p>
    <a href="/admin/laporan/karyawan/preview" class="btn btn-primary" target="_blank" title="Preview">
      <span class="glyphicon glyphicon-print"> </span>
    </a>
              
    {{-- <a href="/admin/laporan/kriteria/excel" class="btn btn-primary" title="Print Excel">
      <span class="glyphicon glyphicon-print"> </span> 
    </a> --}}
</p>


<table class="table table-striped">
        <th>No</th>
        <th>ID Karyawan</th>
        <th>Nama Karyawan</th>
        <th>No Telp Karyawan</th>
        <th>Alamat karyawan</th>
       
        @foreach($karyawans as $no=>$karyawan)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $karyawan->idKaryawan }}</td>
                <td>{{ $karyawan->nmKaryawan }}</td>
                <td>{{ $karyawan->noTelpKar }}</td>
                <td>{{ $karyawan->alamatKar }}</td>
            </tr>
        @endforeach
    </table>

<div class="clearfix"></div>
@endsection