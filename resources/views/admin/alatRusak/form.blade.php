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
              <label for="tglRusak" class="label-control">Tanggal Kerusakan / Hilang</label>
              <input type="text" name="tglRusak" value="{{ date('d-m-Y') }}" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12 {{ $errors->has('alat') ? 'has-error' : '' }}">
              <label for="alat" class="label-control">Peralatan</label>
              <select class="form-control" name="alat" id="alat">
                  <option value=""></option>
                  @foreach($listAlat as $alat)
                      <option value="{{ $alat->id }}">{{ $alat->kdAlat}} | {{ $alat->nmAlat }}</option>
                  @endforeach
              </select>
              {!! $errors->first('alat','<p class=help-block>:message</p>') !!}
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3 {{ $errors->has('jmlRusak') ? 'has-error' : '' }}">
              <label for="jmlRusak" class="label-control">Jumlah Alat Rusak</label>
              <input type="text" name="jmlRusak" class="form-control">
              {!! $errors->first('jmlRusak','<p class=help-block>:message</p>') !!}
            </div>

            <div class="col-md-9 {{ $errors->has('ketAlatRusak') ? 'has-error' : '' }}">
              <label for="ketAlatRusak" class="label-control">Keterangan</label>
              <input type="text" name="ketAlatRusak" class="form-control">
              {!! $errors->first('ketAlatRusak','<p class=help-block>:message</p>') !!}
            </div>
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan </button>
          <a href="/admin/alatrusak/list/{{ date('Y-m') }}" class="btn btn-danger">Batal</a>
        </div>
      </form>
    </div>
  </div>
  <div class="clearfix"></div>
@endsection

@section('footer')
    <script type="text/javascript"> 
        $(document).ready(function(){
            $('#alat').select2();
        })
    </script>
@endsection