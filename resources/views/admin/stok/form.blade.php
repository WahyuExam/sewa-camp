@extends('admin.layoutAdmin')

@section('pemberitahuan')
  <li class="">
      <a href="/admin/pemberitahuan">
         <i class="fa fa-bell-o"   style="font-size:20px"></i>
         <span class="badge bg-red">{{ $jmlPemberitahuan[0]->jml }}</span>
    </a>           
  </li>
@endsection

@section('content')
	    <div class="container">
        {{-- <p><a href="{{ url('/shop') }}">Shop</a> / {{ $product->name }}</p> --}}
        <h3>{{ $dataAlats->nmAlat }}</h3>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('/storage/fotoAlat/'.$dataAlats->fotoAlat) }}" alt="alat" class="img-responsive" width="500px" height="500px">
            </div>

            <div class="col-md-8">
                <form method="POST" class="side-by-side">
                    {!! csrf_field() !!}
                    <input type="hidden" name="alatId" value="{{ $dataAlats->id }}">
                    <input type="hidden" name="nmAlat" value="{{ $dataAlats->nmAlat }}">
        
                    <div class="row">
                        <div class="col-md-4 {{ $errors->has('biayaSewa') ? 'has-error' : '' }}">
                            <label class="label-control">Biaya Sewa (Rp)</label>
                            <input type="text" name="biayaSewa" class="form-control" value="{{ old('biayaSewa') }}">
                            {!! $errors->first('biayaSewa','<p class=help-block>:message</p>') !!}
                        </div>

                        <div class="col-md-4 {{ $errors->has('stokAlat') ? 'has-error' : '' }}">
                            <label class="label-control">Stok Alat</label>
                            <input type="text" name="stokAlat" class="form-control" value="{{ old('stokAlat') }}">
                            {!! $errors->first('stokAlat','<p class=help-block>:message</p>') !!}
                        </div>
                    </div>

                    <br>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    <a href="/admin/stok/list" class="btn btn-danger">Batal</a>

                </form>

            </div> <!-- end col-md-8 -->
        </div> <!-- end row -->
        
        <h4>Dekripsi Peralatan</h4>
        {{ $dataAlats->ketAlat }}

    </div> <!-- end container -->
@endsection