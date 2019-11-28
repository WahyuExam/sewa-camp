@extends('admin.layoutPinjam')

@section('content')
	<div class="container">
		<br><br><br>	
		@if (Session::has('alerts'))
		    @foreach(Session::get('alerts') as $alert)
		      <p><div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div></p>
		    @endforeach
		@endif

		<a href="/admin/pinjam/listalat/{{ $dataSewa->id }}/batal" class="btn btn-danger"> Batalkan Transaksi Peminjaman </a>

		<div class="row">
	        @foreach($listAlat as $alat)
	            <div class="col-md-3">
	                <div class="panel panel-default">
	                    <div class="panel-body">
	                        <a href="/admin/pinjam/detailalat/{{ $dataSewa->kdPinjam }}/{{ $alat->id }}">
	                        	<img src="{{ asset('/storage/fotoAlat/'.$alat->fotoAlat) }}" width="280px" height="200px">
	                        </a>

	                        <h5>{{ $alat->nmAlat }}<h5>
	                        <h5>{{ $alat->merkAlat }}<h5>
	                    </div>
	                </div>
	            </div>
	        @endforeach
   		</div>

   		{!! $listAlat->render() !!}

        <div class="spacer"></div>

    </div> <!-- end container -->
@endsection