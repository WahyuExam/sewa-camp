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

                    <input type="submit" class="btn btn-primary" value="Ubah Jumlah">
                    <a href="/admin/pinjam/keranjang/{{ $idSewa }}" class="btn btn-danger">Batal</a>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="label-control">Stok Alat</label>
                            <input type="text" name="stokAlat" class="form-control" value="{{ $stokAlat->stok}}" readonly>
                        </div>

                        <div class="col-md-4 {{ $errors->has('jmlPinjam') ? 'has-error' : '' }}">
                            <label class="label-control">Jumlah Pinjam</label>
                            <input type="text" name="jmlPinjam" class="form-control" maxlength="2" value="{{ $dataAlats->jml }}">
                            {!! $errors->first('jmlPinjam','<p class=help-block>:message</p>') !!}
                        </div>
                    </div>
                    <input type="hidden" name="jmlPinjamLama" value="{{ $dataAlats->jml }}">
                </form>

                <h4>Dekripsi Peralatan</h4>
                {{ $dataAlats->ketAlat }}
            </div> <!-- end col-md-8 -->
        </div> <!-- end row -->
    </div> <!-- end container -->
@endsection