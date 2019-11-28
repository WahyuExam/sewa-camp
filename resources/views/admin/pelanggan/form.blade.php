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
<br><br><br><br>
  @if (Session::has('alerts'))
    @foreach(Session::get('alerts') as $alert)
      <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
    @endforeach
  @endif

  <div class="panel panel-default">
    <div class="panel panel-body">
      <form method="post" action="/admin/pelanggan/form" autocomplete >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label for="idPel" class="label-control">ID Pelanggan</label>
              <input type="text" name="idPel" value="{{ $kode }}" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('nmPel') ? 'has-error' : '' }}">
          <div class="row">
            <div class="col-md-12">
              <label for="nmPel" class="label-control">Nama Pelanggan</label>
              <input type="text" name="nmPel" value="{{ old('nmPel') }}" class="form-control">  
              {!! $errors->first('nmPel','<p class=help-block>:message</p>') !!}
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('noTelpPel') ? 'has-error' : '' }}">
          <label for="noTelpPel" class="label-control">No Telp Pelanggan</label>
          <input type="text" name="noTelpPel" value="{{ old('noTelpPel') }}" class="form-control" maxlength="12">
          {!! $errors->first('noTelpPel','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
          <label for="email" class="label-control">Email Pelanggan</label>
          <input type="text" name="email" value="{{ old('email') }}" class="form-control">
          {!! $errors->first('email','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('alamatPel') ? 'has-error' : '' }}">
          <label for="alamatPel" class="label-control">Alamat Pelanggan</label>
          <input type="text" name="alamatPel" value="{{ old('alamatPel') }}" class="form-control">
          {!! $errors->first('alamatPel','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan </button>
          <a href="/admin/pelanggan/list" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
  <div class="clearfix"></div>
@endsection