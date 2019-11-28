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
            <input type="text" class="form-control" placeholder="Cari Berdasarkan ID / Nama Karyawan" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <a href="/admin/karyawan/form" class="btn btn-primary">Tambah Data</a>

    <table class="table table-striped table-hover">
    	<th>No</th>
    	<th>ID Karyawan</th>
    	<th>Nama Karyawan</th>
    	<th>No Telp Karyawan</th>
    	<th>Alamat karyawan</th>
    	<th>Action</th>

    	@foreach($listKaryawan as $no=>$karyawan)
    		<form method="get" action="/admin/karyawan/{{ $karyawan->id }}/hapus" class="hapusData">
	    		<tr>
	    			<td>{{ ++$no + $listKaryawan->FirstItem() - 1  }}</td>
	    			<td>{{ $karyawan->idKaryawan }}</td>
	    			<td>{{ $karyawan->nmKaryawan }}</td>
	    			<td>{{ $karyawan->noTelpKar }}</td>
	    			<td>{{ $karyawan->alamatKar }}</td>
	    			<td>
			              <a href="/admin/karyawan/{{ $karyawan->id }}/edit" class="btn btn-primary btn-sm">
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
    	{!! $listKaryawan->render() !!}
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