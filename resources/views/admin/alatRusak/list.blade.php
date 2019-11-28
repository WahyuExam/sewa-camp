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
  @if (Session::has('alerts'))
    @foreach(Session::get('alerts') as $alert)
      <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
    @endforeach
  @endif

  {{-- pencarian --}}
  <form class="row" style="margin-bottom: 20px">
      <div class="col-md-12">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode / Nama Alat" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <a href="/admin/alatrusak/form/{{date('Y-m-d')}}" class="btn btn-primary">Tambah Data</a>

    <table class="table table-striped table-hover">
      <th>No</th>
      <th>Kode Alat</th>
      <th>Nama Alat</th>
      <th>Jumlah Rusak</th>
      <th>Action</th>

      @foreach($listAlatRusak as $no=>$alat)
          <tr>
            <td>{{ ++$no + $listAlatRusak->FirstItem() - 1  }}</td>
            <td>{{ $alat->kdAlat }}</td>
            <td>{{ $alat->nmAlat }}</td>
            <td>{{ $alat->total }}</td>
            <td>
               <a href="/admin/alatrusak/detail/{{ $alat->id }}/{{ $bulan }}" class="btn btn-primary" title="Detail">
                  <span class="fa fa-info"></span>
               </a>
            </td>
          </tr>
      @endforeach
    </table>

    <div class="pull-right">
      {!! $listAlatRusak->render() !!}
    </div>
  <div class="clearfix"></div>
@endsection