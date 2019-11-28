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
            <input type="text" class="form-control" placeholder="Cari Berdasarkan ID / Nama Pelanggan" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <a href="/admin/pelanggan/form" class="btn btn-primary">Tambah Data</a>

    <table class="table table-striped table-hover">
    	<th>No</th>
    	<th>ID Pelanggan</th>
    	<th>Nama Pelanggan</th>
    	<th>No Telp Pelanggan</th>
      <th>Email</th>
      <th>Alamat Pelanggan</th>
      <th>Status Pelanggan</th>
    	<th>Action</th>

    	@foreach($listPelanggan as $no=>$pelanggan)
    		<form method="get" action="/admin/pelanggan/{{ $pelanggan->id }}/hapus" class="hapusData">
	    		<tr>
	    			<td>{{ ++$no + $listPelanggan->FirstItem() - 1  }}</td>
	    			<td>{{ $pelanggan->idPelanggan }}</td>
	    			<td>{{ $pelanggan->nmPelanggan }}</td>
	    			<td>{{ $pelanggan->noTelpPel }}</td>
	    			<td>{{ $pelanggan->email }}</td>
            <td>{{ $pelanggan->alamatPel }}</td>
            <td>{{ $pelanggan->statusPelanggan=='1' ? 'Online' : 'Offline' }}</td>
	    			<td>
			              <a href="/admin/pelanggan/{{ $pelanggan->id }}/edit" class="btn btn-primary btn-sm">
			                  <span class="glyphicon glyphicon-pencil"></span>
			              </a>
			              
			              <button class="btn btn-danger btn-sm" type="submit" >
			                <span class="glyphicon glyphicon-trash"></span>
			              </button>
	    			</td>
	    		</tr>
    		</form>
    	@endforeach
    </table>

    <div class="pull-right">
    	{!! $listPelanggan->render() !!}
    </div>
	<div class="clearfix"></div>
@endsection

@section('footer')
  <script>
    $(document).ready(function(){
      $('.hapusData').on('submit',function(){
        return confirm("Apakah Data Akan Dihapus ?");
      })
    })
  </script>
@endsection