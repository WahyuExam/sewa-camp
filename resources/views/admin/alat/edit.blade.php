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
  @if (Session::has('pesans'))
    @foreach(Session::get('pesans') as $alert)
      <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
    @endforeach
  @endif

  <div class="panel panel-default">
    <div class="panel panel-body">
      <form method="post" autocomplete  enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label for="kdAlat" class="label-control">Kode Alat</label>
              <input type="text" name="kdAlat" value="{{ $dataAlat->kdAlat }}" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('nmAlat') ? 'has-error' : '' }}">
          <div class="row">
            <div class="col-md-12">
              <label for="nmAlat" class="label-control">Nama Peralatan</label>
              <input type="text" name="nmAlat" value="{{ $dataAlat->nmAlat }}" class="form-control">  
              {!! $errors->first('nmAlat','<p class=help-block>:message</p>') !!}
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('merkAlat') ? 'has-error' : '' }}">
          <label for="merkAlat" class="label-control">Merk Peralatan</label>
          <input type="text" name="merkAlat" value="{{ $dataAlat->merkAlat }}" class="form-control">
          {!! $errors->first('merkAlat','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('ketAlat') ? 'has-error' : '' }}">
          <label for="ketAlat" class="label-control">Keterangan Perlatan</label>
          <textarea name="ketAlat" class="form-control" rows="6">{{ $dataAlat->ketAlat }}</textarea>
          {!! $errors->first('ketAlat','<p class=help-block>:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('fotoAlat') ? 'has-error' : '' }}">
              <label for="foto" class="label-control">Foto Peralatan</label><br>         
              <img src="{{ asset('/storage/fotoAlat/'.$dataAlat->fotoAlat ) }}" width="250" height="200" alt="Foto Tidak Ada" id="foto"><br><br>
            
              <label class="btn btn-sm btn-info fa fa-camera">
                <input type="file" name="fotoAlat" accept="image/jpeg" style="display:none;" onchange="previewGambar(this)" />
              </label>
              {!! $errors->first('fotoAlat','<p class=help-block>:message</p>') !!}    
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan </button>
          <a href="/admin/alat/list" class="btn btn-default">Batal</a>
        </div>

        <input type="hidden" name="nmAlatLama" value="{{ $dataAlat->nmAlat }}">
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