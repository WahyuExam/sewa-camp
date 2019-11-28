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
      <form method="post" action="/admin/karyawan/form" autocomplete enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label for="idKar" class="label-control">ID Karyawan</label>
              <input type="text" name="idKar" value="{{ $kode }}" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('nmKar') ? 'has-error' : '' }}">
          <div class="row">
            <div class="col-md-12">
              <label for="nmKar" class="label-control">Nama Karyawan</label>
              <input type="text" name="nmKar" value="{{ old('nmKar') }}" class="form-control">  
              {!! $errors->first('nmKar','<p class=help-block>:message</p>') !!}
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('noTelpKar') ? 'has-error' : '' }}">
          <label for="noTelpKar" class="label-control">No Telp Karyawan</label>
          <input type="text" name="noTelpKar" value="{{ old('noTelpKar') }}" class="form-control" maxlength="12">
          {!! $errors->first('noTelpKar','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('alamatKar') ? 'has-error' : '' }}">
          <label for="alamatKar" class="label-control">Alamat Karyawan</label>
          <input type="text" name="alamatKar" value="{{ old('alamatKar') }}" class="form-control">
          {!! $errors->first('alamatKar','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('fotoKaryawan') ? 'has-error' : '' }}">
            <label for="foto" class="label-control">Foto Karyawan</label><br>         
            <img src="{{ asset('foto/sample.gif') }}" width="250" height="200" alt="Foto Tidak Ada" id="foto"><br><br>
          
            <label class="btn btn-sm btn-info fa fa-camera">
              <input type="file" name="fotoKaryawan" accept="image/jpeg" style="display:none;" onchange="previewGambar(this)" />
            </label>
            {!! $errors->first('fotoKaryawan','<p class=help-block>:message</p>') !!}    
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan </button>
          <a href="/admin/karyawan/list" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
  <div class="clearfix"></div>
@endsection

@section('footer')
{{-- <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>    --}}
  <script>
    function previewGambar(input){
      if (input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
          $(foto).attr('src',e.target.result);
        }
          reader.readAsDataURL(input.files[0]);
      };
    };

  </script>
@endsection