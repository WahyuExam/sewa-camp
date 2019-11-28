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
  <h3>Detail Alat Rusak</h3><hr>
  <table class="table table-striped table-hover">
    <th>No</th>
    <th>Tanggal Kerusakan</th>
    <th>Kode Alat</th>
    <th>Nama Alat</th>
    <th>Jumlah Rusak</th>
    <th>Keterangan</th>

    @foreach($alatRusaks as $no=>$alat)
        <tr>
          <td>{{ ++$no }}</td>
          <td>{{ $alat->tglRusak }}</td>
          <td>{{ $alat->kdAlat }}</td>
          <td>{{ $alat->nmAlat }}</td>
          <td>{{ $alat->jmlRusak }}</td>
          <td>{{ $alat->ket }}</td>
        </tr>
    @endforeach
  </table>

  <a href="/admin/alatrusak/list/{{ date('Y-m') }}" class="btn btn-danger">Kembali</a>

  <div class="clearfix"></div>
@endsection