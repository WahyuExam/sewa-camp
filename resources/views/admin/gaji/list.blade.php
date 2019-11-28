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
  
  <form method="POST" action="" autocomplete>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="panel panel-default">
          <div class="panel-heading"><h4>Form GaJi Karyawan</h4></div>
          <div class="panel-body">
              <div class="form-group">
                  <div class="row">
                      <div class="col-md-2">
                          <label for="tglGaji" class="label-control">Tanggal Penggajihan</label>  
                          <input type="text" name="tglGaji" class="form-control" value="{{ date('d - m - Y') }}" readonly>
                      </div>
                  </div>
              </div>

              <div class="form-group {{ $errors->has('nmKar') ? 'has-error' : '' }}">
                  <div class="row">
                      <div class="col-md-12">
                          <label for="nmKar" class="label-control">Nama Karyawan</label>  
                          <select name="nmKar" class="form-control" id="nmKar">
                              <option value=""></option>
                              @foreach($listKaryawan as $karyawan)
                                  <option value="{{ $karyawan->id }}">{{ $karyawan->idKaryawan }} | {{ $karyawan->nmKaryawan }} </option>
                              @endforeach
                          </select>
                          {!! $errors->first('nmKar','<p class=help-block>:message</p>') !!}
                      </div>
                  </div>
              </div>

              <div class="form-group {{ $errors->has('gaji') ? 'has-error' : '' }}">
                  <div class="row">
                      <div class="col-md-6">
                          <label for="gaji" class="label-control">Nama Peralatan</label>  
                          <input type="text" name="gaji" class="form-control" value="{{ old('gaji') }}"> 
                          {!! $errors->first('gaji','<p class=help-block>:message</p>') !!}
                      </div>
                  </div>
              </div>

              <input type="submit" class="btn btn-primary" value="Simpan">
              <a href="/admin" class="btn btn-default">Batal</a>

          </div>
      </div>
  </form>
  
  @if (count($listGaji)<>0)
      <table class="table table-striped table-hover">
      	<th>No</th>
      	<th>Tgl Gaji</th>
      	<th>Nama Karyawan</th>
      	<th>Total Gaji</th>
        <th>Action</th>

      	@foreach($listGaji as $no=>$gaji)
    				<tr>
    	    			<td>{{ ++$no }}</td>
    	    			<td>{{ $gaji->tglGaji }}</td>
    	    			<td>{{ $gaji->nmKaryawan }}</td>
    	    			<td>Rp. {{ number_format($gaji->gaji) }}</td>
                <td>
                   <form method="get" action="/admin/gaji/{{ $gaji->id }}/hapus" class="hapusData">
                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Data"><span class="fa fa-trash"></span></button>
                    </form>
              </td>
        		</tr>
      	@endforeach
      </table>
  @endif

  @if (count($listGaji)==count($listKaryawan))
      <h5>Ket : Semua Karyawan Sudah Digaji</h5>
  @endif

	<div class="clearfix"></div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#nmKar').select2();

            $('.hapusData').on('submit',function(){
                return confirm("Apakah Data Akan Dihapus ?");
            })
        })
    </script>
@endsection