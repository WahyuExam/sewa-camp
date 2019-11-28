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

    <table class="table table-striped table-hover">
      <th>No</th>
      <th>Kode Peralatan</th>
      <th>Nama Peralatan</th>
      <th>Biaya Sewa (Rp)</th>
      <th>Denda Sewa Perhari (Rp)</th>
      <th>Stok</th>
      <th>Action</th>

      @foreach($listAlat as $no=>$alat)
          <tr>
            <td>{{ ++$no + $listAlat->FirstItem() - 1  }}</td>
            <td>{{ $alat->kdAlat }}</td>
            <td>{{ $alat->nmAlat }}</td>
            <td>{{ number_format($alat->biayaSewa)  }}</td>
            <td>{{ number_format($alat->biayaDenda) }}</td>
            <td>{{ $alat->stok }}</td>
            <td>
                @if(empty($alat->biayaSewa) && empty($alat->stok))
                    <a href="/admin/stok/form/{{ $alat->id }}" class="btn btn-primary btn-sm" title="Setting Stok & Biaya Sewa">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                @else
                    <a href="/admin/stok/form/{{ $alat->id }}/edit" class="btn btn-danger btn-sm" title="update Stok & Biaya Sewa">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>                  
                @endif
            </td>
          </tr>
        </form>
      @endforeach
    </table>

    <div class="pull-right">
    	{!! $listAlat->render() !!}
    </div>
	<div class="clearfix"></div>
@endsection