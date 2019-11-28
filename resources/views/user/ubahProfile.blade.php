@extends('user.layoutUser')
{{-- {{dd($dataPelanggan)}} --}}
@section('content') 
  <div class="container">
        @if ($dataPelanggan->alamatPel=='' || $dataPelanggan->noTelpPel=='')
            <div class="alert alert-success">
                Silahkan Untuk Melengkapai Data Profile Anda !
            </div>
        @endif  

       <div class="panel panel-default">
          <div class="panel panel-body">
            
            <form method="post" autocomplete >
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label for="idPel" class="label-control">ID Pelanggan</label>
                    <input type="text" name="idPel" value="{{ $dataPelanggan->idPelanggan }}" class="form-control" readonly>
                  </div>
                </div>
              </div>

              <div class="form-group {{ $errors->has('nmPel') ? 'has-error' : '' }}">
                <div class="row">
                  <div class="col-md-12">
                    <label for="nmPel" class="label-control">Nama Pelanggan</label>
                    <input type="text" name="nmPel" value="{{ $dataPelanggan->nmPelanggan }}" class="form-control">  
                    {!! $errors->first('nmPel','<p class=help-block>:message</p>') !!}
                  </div>
                </div>
              </div>

              <div class="form-group {{ $errors->has('noTelpPel') ? 'has-error' : '' }}">
                <label for="noTelpPel" class="label-control">No Telp Pelanggan</label>
                <input type="text" name="noTelpPel" value="{{ $dataPelanggan->noTelpPel }}" class="form-control" maxlength="12">
                {!! $errors->first('noTelpPel','<p class=help-block>:message</p>') !!}
              </div>

              <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email" class="label-control">Email Pelanggan</label>
                <input type="text" name="email" value="{{ $dataPelanggan->email }}" class="form-control">
                {!! $errors->first('email','<p class=help-block>:message</p>') !!}
              </div>

              <div class="form-group {{ $errors->has('alamatPel') ? 'has-error' : '' }}">
                <label for="alamatPel" class="label-control">Alamat Pelanggan</label>
                <input type="text" name="alamatPel" value="{{ $dataPelanggan->alamatPel}}" class="form-control">
                {!! $errors->first('alamatPel','<p class=help-block>:message</p>') !!}
              </div>

              <div class="form-group {{ $errors->has('pengguna') ? 'has-error' : '' }}">
                <label for="pengguna" class="label-control">Pengguna</label>
                <input type="text" name="pengguna" value="{{ $dataPelanggan->pengguna}}" class="form-control">
                {!! $errors->first('pengguna','<p class=help-block>:message</p>') !!}
              </div>

              <div class="form-group {{ $errors->has('sandi') ? 'has-error' : '' }}">
                <label for="sandi" class="label-control">Sandi</label>
                <input type="password" name="sandi" value="{{ $dataPelanggan->sandi}}" class="form-control">
                {!! $errors->first('sandi','<p class=help-block>:message</p>') !!}
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan </button>
        
                @if ($dataPelanggan->alamatPel<>'' || $dataPelanggan->noTelpPel<>'')
                    <a href="/" class="btn btn-default">Batal</a>
                @endif
              </div>

              <input type="hidden" name="emailLama" value="{{ $dataPelanggan->email }}">
              <input type="hidden" name="penggunaLama" value="{{ $dataPelanggan->pengguna }}">
              <input type="hidden" name="idPelanggan" value="{{ $dataPelanggan->id }}">
            </form>
          </div>
        </div>   
  </div>
 
  <div class="clearfix"></div>
@endsection