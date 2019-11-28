@extends('user.layoutUser')

@section('content')
  <div class="container">
      @if (Session::has('alerts'))
        @foreach(Session::get('alerts') as $alert)
          <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
        @endforeach
      @endif

      <form method="post"  enctype="multipart/form-data" autocomplete>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
          <div class="form-group">
              <div class="row">
                  <div class="col-md-3 {{ $errors->has('tglBayar') ? 'has-error' : '' }}">
                      <label class="label-control" for="tglBayar">Tanggal Bayar</label>
                      <input type="date" class="form-control" name="tglBayar" value="{{ date('Y-m-d') }}">
                      {!! $errors->first('tglBayar','<p class=help-block>:message</p>') !!}
                  </div>
              </div>  
          </div>

           <div class="form-group">
              <div class="row">
                  <div class="col-md-12">
                      <label class="label-control" for="ket">Catatan Pelanggan</label>
                      <textarea class="form-control" name="ket" rows="4"></textarea>
                  </div>
              </div>  
          </div>

          <div class="form-group {{ $errors->has('bukti') ? 'has-error' : '' }}">
              <label for="foto" class="label-control">Bukti Pembayaran</label><br>         
              <img src="{{ asset('foto/sample.gif') }}" width="250" height="200" alt="Foto Tidak Ada" id="foto"><br><br>
                
              <label class="btn btn-sm btn-info glyphicon glyphicon-camera">
                  <input type="file" name="bukti" accept="image/jpeg" style="display:none;" onchange="previewGambar(this)" />
              </label>
              {!! $errors->first('bukti','<p class=help-block>:message</p>') !!}    
          </div>

          <div class="form-group">
              <button type="submit" class="btn btn-primary">konfirmasi</button>
              <a href="/user/booking/list/{{session('auth')->id}}" class="btn btn-default">Batal</a>
          </div>
      </form>

      <div class="clearfix"></div>
  </div>
@endsection

@section('footer')
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