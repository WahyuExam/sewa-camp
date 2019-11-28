@extends('user.layoutUser')

@section('content')
	<div class="container">
		@if (Session::has('alerts'))
            @foreach(Session::get('alerts') as $alert)
              <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
            @endforeach
        @endif

		<div class="row">
	        @foreach($listAlat as $alat)
	            <div class="col-md-3">
	                <div class="panel panel-default">
	                    <div class="panel-body">
	                        <a href="/user/booking/detailalatsewa/{{ $kdSewa }}/{{ $alat->id }}">
	                        	<img src="{{ asset('/storage/fotoAlat/'.$alat->fotoAlat) }}" width="230px" height="200px">
	                        </a>

	                        <h5>{{ $alat->nmAlat }}<h5>
	                        <h5>{{ $alat->merkAlat }}<h5>
	                    </div>
	                </div>
	            </div>
	        @endforeach
   		</div>

        <div class="spacer"></div>

    </div> <!-- end container -->
@endsection