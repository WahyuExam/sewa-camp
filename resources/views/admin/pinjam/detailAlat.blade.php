@extends('admin.layoutPinjam')

@section('content')
        <br><br><br><br>
        @if (Session::has('alerts'))
            @foreach(Session::get('alerts') as $alert)
              <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
            @endforeach
        @endif
	    
        <div class="container">
        {{-- <p><a href="{{ url('/shop') }}">Shop</a> / {{ $product->name }}</p> --}}
        <h3>{{ $dataAlats->nmAlat }}</h3>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('/storage/fotoAlat/'.$dataAlats->fotoAlat) }}" alt="alat" class="img-responsive" width="500px" height="700px">
            </div>

            <div class="col-md-8">
                <form method="POST" class="side-by-side">
                    {!! csrf_field() !!}
                    <input type="hidden" name="alatId" value="{{ $dataAlats->id }}">
                    <input type="hidden" name="nmAlat" value="{{ $dataAlats->nmAlat }}">

                    <input type="submit" class="btn btn-primary" value="Tambah Kedalam Keranjang">
                    <a href="/admin/pinjam/listalat/{{ $kdSewa }}" class="btn btn-danger">Kembali Ke List Peralatan</a>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="label-control">Stok Alat</label>
                            <input type="text" name="stokAlat" class="form-control" value="{{ $dataAlats->stok<>'' ? $dataAlats->stok : '0' }}" readonly>
                        </div>

                        <div class="col-md-4 {{ $errors->has('jmlPinjam') ? 'has-error' : '' }}">
                            <label class="label-control">Jumlah Pinjam</label>
                            <input type="text" name="jmlPinjam" class="form-control" maxlength="2">
                            {!! $errors->first('jmlPinjam','<p class=help-block>:message</p>') !!}
                        </div>
                    </div>
                </form>

                <h4>Dekripsi Peralatan</h4>
                {{ $dataAlats->ketAlat }}
            </div> <!-- end col-md-8 -->
        </div> <!-- end row -->

        <br><br>
        <h3>Peralatan Lain Yang Tersedia...</h3>
        <div class="row">
            @foreach($randomAlats as $alat)
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="/admin/pinjam/detailalat/{{ $kdSewa }}/{{ $alat->id }}">
                                <img src="{{ asset('/storage/fotoAlat/'.$alat->fotoAlat) }}" width="280px" height="200px">
                            </a>

                            <h5>{{ $alat->nmAlat }}<h5>
                            <h5>{{ $alat->merkAlat }}<h5>
                        </div>
                    </div>
                </div>
            @endforeach

        </div> <!-- end row -->

        <div class="spacer"></div>

    </div> <!-- end container -->
@endsection