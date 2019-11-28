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
  
  <form method="POST" autocomplete>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="panel panel-default">
          <div class="panel-heading"><h4>Form Proses Pengembalian Peralatan</h4></div>
          <div class="panel-body">
              <div class="form-group">
                  <div class="row">
                      <div class="col-md-12">
                          <label for="alat" class="label-control">Alat</label>  
                          <input type="text" name="alat" class="form-control" value="{{ $pinjams->nmAlat }}" readonly>
                      </div>
                  </div>
              </div>

              <div class="form-group">
                  <div class="row">
                      <div class="col-md-12">
                          <label for="jmlPinjam" class="label-control">Jumlah Pinjam</label>  
                          <input type="text" name="jmlPinjam" class="form-control" value="{{ $pinjams->jml }}" readonly id="jmlAlat"> 
                      </div>
                  </div>  
              </div>

              <div class="form-group">
                  <div class="row">
                      <div class="col-md-6 {{ $errors->has('alatRusak') ? 'has-error' : ''}}">
                          <label for="alatRusak" class="label-control">Jumlah Alat Rusak</label>  
                          <input type="text" name="alatRusak" class="form-control" id="alatRusak" onKeyup="hitung()" value="0">
                          {!! $errors->first('alatRusak','<p class=help-block>:message</p>') !!} 
                      </div>

                      <div class="col-md-6">
                          <label for="alatBaik" class="label-control">Jumlah Alat Baik</label>  
                          <input type="text" name="alatBaik" class="form-control"  value="{{ $pinjams->jml }}" readonly id="alatBaik"> 
                      </div>
                  </div>
              </div>

              <div class="form-group">
                  <div class="row">
                      <div class="col-md-6 {{ $errors->has('biayaAlatRusak') ? 'has-error' : ''}}">
                          <label for="biayaAlatRusak" class="label-control">Biaya Per Alat</label>  
                          <input type="text" name="biayaAlatRusak" class="form-control" id="biayaAlatRusak" onKeyup="hitung()" value="0">
                          {!! $errors->first('biayaAlatRusak','<p class=help-block>:message</p>') !!} 
                      </div>

                      <div class="col-md-6">
                          <label for="ttlBiayaAlatRusak" class="label-control">Total Biaya</label>  
                          <input type="text" name="ttlBiayaAlatRusak" class="form-control"  value="0" readonly id="ttlBiayaAlatRusak"> 
                      </div>
                  </div>
              </div>

              <div class="pull-left">
                   <input type="submit" class="btn btn-primary" value="Simpan">
                   <a href="/admin/kembali/{{ $pinjams->kdPinjam }}/form" class="btn btn-danger">Batal</a>
              </div>
          </div>
      </div>
    
  </form>
  
	<div class="clearfix"></div>
@endsection

@section('footer')
  <script type="text/javascript">
      function hitung() 
      {
          var a     = $("#jmlAlat").val();
          var b     = $("#alatRusak").val();
          var biaya = $("#biayaAlatRusak").val();
        
          c = a - b;
          if(c < 0){
            alert('Error ! Melebihi Jumlah Pinjam');
            $("#alatRusak").val(0);
            $("#biayaAlatRusak").val(0);
            $("#ttlBiayaAlatRusak").val(0);
          }
          else{
            total = biaya * b;
            $("#alatBaik").val(c);
            $("#ttlBiayaAlatRusak").val(total);
          };
      }
  </script>
@endsection