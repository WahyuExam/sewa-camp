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
      <form method="post" action="/admin/suplier/{{ $data->id }}/edit" autocomplete >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label for="kdSup" class="label-control">Kode Suplier</label>
              <input type="text" name="kdSup" value="{{ $data->kdSuplier }}" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('nmSup') ? 'has-error' : '' }}">
          <div class="row">
            <div class="col-md-12">
              <label for="nmSup" class="label-control">Nama Suplier</label>
              <input type="text" name="nmSup" value="{{ $data->nmSuplier }}" class="form-control">  
              {!! $errors->first('nmSup','<p class=help-block>:message</p>') !!}
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('noTelpSup') ? 'has-error' : '' }}">
          <label for="noTelpSup" class="label-control">No Telp Suplier</label>
          <input type="text" name="noTelpSup" value="{{ $data->noTelp }}" class="form-control" maxlength="12">
          {!! $errors->first('noTelpSup','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('alamatSup') ? 'has-error' : '' }}">
          <label for="alamatSup" class="label-control">Alamat Suplier</label>
          <input type="text" name="alamatSup" value="{{ $data->alamat }}" class="form-control">
          {!! $errors->first('alamatSup','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan </button>
          <a href="/admin/suplier/list" class="btn btn-default">Batal</a>
        </div>

        <input type="hidden" value="{{ $data->nmSuplier}}" name="nmSupLama">
        <input type="hidden" value="{{ $data->alamat}}" name="alamatSupLama">
        <input type="hidden" value="{{ $data->noTelp}}" name="noTelpSupLama">
      </form>
    </div>
  </div>
  <div class="clearfix"></div>
@endsection