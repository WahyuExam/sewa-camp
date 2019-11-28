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
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode / Nama Suplier" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <a href="/admin/suplier/form" class="btn btn-primary">Tambah Data</a>

    <table class="table table-striped table-hover">
    	<th>No</th>
    	<th>Kode Suplier</th>
    	<th>Nama Suplier</th>
    	<th>No Telp Suplier</th>
    	<th>Alamat Suplier</th>
    	<th>Action</th>

    	@foreach($listSuplier as $no=>$suplier)
    		<form method="get" action="/admin/suplier/{{ $suplier->id }}/hapus" class="hapusData">
	    		<tr>
	    			<td>{{ ++$no + $listSuplier->FirstItem() - 1  }}</td>
	    			<td>{{ $suplier->kdSuplier }}</td>
	    			<td>{{ $suplier->nmSuplier }}</td>
	    			<td>{{ $suplier->noTelp }}</td>
	    			<td>{{ $suplier->alamat }}</td>
	    			<td>
			              <a href="/admin/suplier/{{ $suplier->id }}/edit" class="btn btn-primary btn-sm">
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
    	{!! $listSuplier->render() !!}
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