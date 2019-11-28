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
            <div class="col-md-4">
              <label for="kdSewa" class="label-control">Kode Sewa</label>
              <input type="text" name="kdSewa" value="{{ $booking->kdPinjam}}" class="form-control" readonly>
            </div>

            <div class="col-md-4">
              <label for="tglSewa" class="label-control">Tanggal Sewa</label>
              <input type="text" name="tglSewa" value="{{ date('d-m-Y') }}" class="form-control" readonly>
            </div>

            <div class="col-md-4">
              <label for="lamaPinjam" class="label-control">Lama Pinjam</label>
              <input type="text" name="lamaPinjam" value="{{ $booking->lamaPinjam }} Hari" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nmPelanggan" class="label-control">Nama Pelanggan</label>
              <input type="text" name="nmPelanggan" value="{{ $booking->nmPelanggan }}" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4 {{ $errors->has('jaminan') ? 'has-error' : '' }}">
              <label for="jaminan" class="label-control">Jaminan</label>
              <select class="form-control" name="jaminan">
                  <option value=""></option>
                  <option value="SIM">SIM</option>
                  <option value="KTP">KTP</option>
                  <option value="KPL">Kartu Pelajar</option>
              </select>
              {!! $errors->first('jaminan','<p class=help-block>:message</p>') !!}
            </div>

            <div class="col-md-8 {{ $errors->has('noJaminan') ? 'has-error' : '' }}">
              <label for="noJaminan" class="label-control">Nomer Jaminan</label>
              <input type="text" name="noJaminan" class="form-control">
              {!! $errors->first('noJaminan','<p class=help-block>:message</p>') !!}
            </div>

          </div>      
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan </button>
          <a href="/admin/booking/list" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
  <div class="clearfix"></div>
@endsection