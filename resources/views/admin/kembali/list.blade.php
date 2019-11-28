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
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode Sewa / Nama Karyawan" name="q"/>
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
    	<th>Kode Sewa</th>
    	<th>Tanggal Sewa</th>
      <th>Tanggal Kembali</th>
    	<th>Nama Pelanggan</th>
    	<th>Status</th>

    	@foreach($listPinjam as $no=>$pinjam)
  				<tr>
  	    			<td>{{ ++$no + $listPinjam->FirstItem() - 1  }}</td>
  	    			<td>{{ $pinjam->kdPinjam }}</td>
              <td>{{ date('d-m-Y',strtotime($pinjam->tglPinjam)) }}</td>
              <td>{{ $pinjam->tglkembali ? date('d-m-Y',strtotime($pinjam->tglkembali)) : '-' }}</td>
  	    			<td>{{ $pinjam->nmPelanggan }}</td>
              <td>
                  @if ($pinjam->statusSewa==2)
                      <a href="/admin/kembali/{{ $pinjam->kdPinjam }}/form" class="btn btn-primary" title="Masih Dalam Peminjaman">Proses</a>
                  @else
                      <h4 class="btn btn-default" title="Peralatan Sudah Dikembalikan">Kembali</h4>
                  @endif
              </td>
	    		</tr>
    	@endforeach
    </table>

    <div class="pull-right">
    	{!! $listPinjam->render() !!}
    </div>
	<div class="clearfix"></div>
@endsection