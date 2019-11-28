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
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode Sewa / Nama Pelanggan" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <a href="/admin/pinjam/formOffline/{{ date('Y-m-d') }}" class="btn btn-primary">Sewa Offline</a>

    <table class="table table-striped table-hover">
    	<th>No</th>
    	<th>Kode Sewa</th>
    	<th>Tanggal Sewa</th>
    	<th>Nama Pelanggan</th>
    	<th>Status</th>

    	@foreach($listPinjam as $no=>$pinjam)
      		<form method="get" action="/admin/karyawan/{{ $pinjam->id }}/hapus" class="hapusData">
    	    		<tr>
      	    			<td>{{ ++$no + $listPinjam->FirstItem() - 1  }}</td>
      	    			<td>{{ $pinjam->kdPinjam }}</td>
      	    			<td>{{ $pinjam->tglPinjam }}</td>
      	    			<td>{{ $pinjam->nmPelanggan }}</td>
                  <td>{{ $pinjam->statusSewa==2 ? 'Pinjam' : '' }}</td>
    	    		</tr>
      		</form>
    	@endforeach
    </table>

    <div class="pull-right">
    	{!! $listPinjam->render() !!}
    </div>
	<div class="clearfix"></div>
@endsection