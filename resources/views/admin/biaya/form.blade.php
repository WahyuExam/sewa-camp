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
          <div class="panel-heading"><h4>Form Biaya Operasional</h4></div>
          <div class="panel-body">
              <div class="form-group">
                  <div class="row">
                      <div class="col-md-3">
                          <label for="kdOperasional" class="label-control">Kode Operasional</label>  
                          <input type="text" name="kdOperasional" class="form-control" value="{{ $kdOperasional }}" readonly>
                      </div>
                      
                      <div class="col-md-3">
                          <label for="tglOperasional" class="label-control">Tanggal Penggajihan</label>  
                          <input type="text" name="tglOperasional" class="form-control" value="{{ date('d - m - Y') }}" readonly>
                      </div>

                  </div>
              </div>  

              <div class="form-group {{ $errors->has('ket') ? 'has-error' : '' }}">
                  <div class="row">
                      <div class="col-md-12">
                          <label for="ket" class="label-control">Keterangan Operasional</label>  
                          <input type="text" name="ket" class="form-control"> 
                          {!! $errors->first('ket','<p class=help-block>:message</p>') !!}
                      </div>
                  </div>
              </div>

              <div class="form-group {{ $errors->has('biaya') ? 'has-error' : '' }}">
                  <div class="row">
                      <div class="col-md-12">
                          <label for="biaya" class="label-control">biaya Operasional</label>  
                          <input type="text" name="biaya" class="form-control"> 
                          {!! $errors->first('biaya','<p class=help-block>:message</p>') !!}
                      </div>
                  </div>
              </div>

              <div class="pull-left">
                   <input type="submit" class="btn btn-primary" value="Simpan">
              </div>

              <div class="pull-right">
                  <a href="/admin/biaya/batal/{{ $kdOperasional }}" class="btn btn-danger">Batalkan Transaksi</a>

                  @if(count($listDetail)<>0)
                      <a href="/admin/biaya/list/{{ date('Y-m-d') }}" class="btn btn-success">Selesaikan Transaksi</a>            
                  @endif

              </div>
          </div>
      </div>
      <input type="hidden" name="idOperasional" value="{{ $idOperasional }}">
      <input type="hidden" name="total" value="{{ $ttlBiaya }}">
  </form>
    
  @if (count($listDetail)<>0)
      <table class="table table-striped table-hover">
      	<th>No</th>
      	<th>Keterangan Operasional</th>
      	<th>Biaya Operasional</th>
        <th>Action</th>
    
      	@foreach($listDetail as $no=>$detail)
    				<tr>
    	    			<td>{{ ++$no }}</td>
    	    			<td>{{ $detail->ket }}</td>
    	    			<td>Rp. {{ number_format($detail->biaya) }}</td>
                <td>
                    <form method="get" action="/admin/biaya/formOperasional/{{ $detail->operasionalId }}/{{ $detail->id }}/hapus" class="hapusData">
                        <button type="submit" class="btn btn-danger" title="Hapus Item">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </form>
                </td>
        		</tr>
      	@endforeach

        <tr>
            <td></td>
            <td colspan="1" align="right"><strong>Total Biaya</strong></td>
            <td><strong>Rp. {{ number_format($ttlBiaya) }}</strong></td>
            <td></td>
        </tr>
      </table>
  @endif

	<div class="clearfix"></div>
@endsection

@section('footer')
  <script>
    $(document).ready(function(){
      $('.hapusData').on('submit',function(){
        return confirm("Apakah Data Akan Dihapus ?");
      })
    })
  </script>
@endsection