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
      <form method="post" autocomplete >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label for="kdUser" class="label-control">Kode User</label>
              <input type="text" name="kdUser" value="{{ $users->kodeUser }}" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="pengguna" class="label-control">Pengguna</label>
              <input type="text" name="pengguna" value="{{ $users->pengguna }}" class="form-control" readonly>  
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('sandiBaru') ? 'has-error' : '' }}">
          <label for="sandiBaru" class="label-control">Kata Sandi Baru</label>
          <input type="password" name="sandiBaru" class="form-control" maxlength="12">
          {!! $errors->first('sandiBaru','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan </button>
          <a href="/admin/manajemen/user/list" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
  <div class="clearfix"></div>
@endsection