@extends('user.layoutUser')

@section('content')

	<div class="container">
		<h1>CAMP OUTDOOR SERVICE AND RENT</h1>
		<div class="row">
	        @foreach($alats as $alat)
	            <div class="col-md-3">
	                <div class="panel panel-default">
	                    <div class="panel-body">
	                        <a href="/user/detailAlat/{{ $alat->id }}">
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