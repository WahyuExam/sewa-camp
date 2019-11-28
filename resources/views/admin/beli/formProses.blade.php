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
              <label for="kdBeli" class="label-control">Kode Beli</label>
              <input type="text" name="kdBeli" value="{{ $kdBeli }}" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label for="tglBeli" class="label-control">Tanggal Beli</label>
              <input type="text" name="tglBeli" value="{{ date('d-m-Y') }}" class="form-control" readonly>
            </div>
          </div>
        </div>

        {{-- {{dd($supliers)}} --}}
        <div class="form-group">
          <div class="row">
            <div class="col-md-12 {{ $errors->has('suplier') ? 'has-error' : '' }}">
              <label for="suplier" class="label-control">Suplier</label>
              <select class="form-control" name="suplier" id="suplier" disabled>
                  <option value=""></option>
                  @foreach($supliers as $suplier)
                      <option value="{{ $suplier->id }}" {{ $suplier->id==$dataBeli->suplierId ? 'selected' : '' }}>{{ $suplier->kdSuplier}} | {{ $suplier->nmSuplier }}</option>
                  @endforeach
              </select>
              {!! $errors->first('suplier','<p class=help-block>:message</p>') !!}
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-12 {{ $errors->has('alat') ? 'has-error' : '' }}">
              <label for="alat" class="label-control">Peralatan</label>
              <select class="form-control" name="alat" id="alat">
                  <option value=""></option>
                  @foreach($alats as $alat)
                      <option value="{{ $alat->id }}">{{ $alat->kdAlat}} | {{ $alat->nmAlat }}</option>
                  @endforeach
              </select>
              {!! $errors->first('alat','<p class=help-block>:message</p>') !!}
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-6 {{ $errors->has('hargaBeli') ? 'has-error' : '' }}">
              <label for="hargaBeli" class="label-control">Harga Beli (Rp)</label>
              <input type="text" name="hargaBeli" class="form-control">
              {!! $errors->first('hargaBeli','<p class=help-block>:message</p>') !!}
            </div>

            <div class="col-md-6 {{ $errors->has('jmlBeli') ? 'has-error' : '' }}">
              <label for="jmlBeli" class="label-control">Jumlah Beli</label>
              <input type="text" name="jmlBeli" class="form-control">
              {!! $errors->first('jmlBeli','<p class=help-block>:message</p>') !!}
            </div>
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan Item</button>
         
          <div class="pull-right">
              @if (count($detailBeli)<>0)
                  <a href="/admin/beli/{{ $kdBeli }}/selsai" class="btn btn-success">Selesaikan Transaksi</a>
              @endif
              
              <a href="/admin/beli/batal/{{ $kdBeli }}" class="btn btn-danger">Batal Transaksi</a>
          </div>
        </div>
      </form> 
    </div>
  </div>

  @if (count($detailBeli)<>0)
      <table class="table table-striped">
          <th>No</th>
          <th>Alat</th>
          <th>Harga Beli</th>
          <th>Jumlah Beli</th>
          <th>Sub Total</th>
          <th>Action</th>
        
          @foreach($detailBeli as $no=>$beli)
              <tr>
                  <td>{{ ++$no }}</td>
                  <td>{{ $beli->nmAlat }}</td>
                  <td>Rp. {{ number_format($beli->hargaBeli)}}</td>
                  <td>{{ $beli->jmlBeli }}</td>
                  <td>Rp. {{ number_format($beli->sub) }}</td>
                  <td>
                     <form class="hapusData" method="get" action="/admin/beli/{{ $beli->beliId }}/{{ $beli->alatId}}/hapus">
                        <button class="btn btn-danger" type="submit" title="Hapus Item" >
                            <span class="fa fa-trash"></span>
                        </button> 
                     </form>
                  </td>
              </tr>
          @endforeach

          <td colspan="4" align="right"><strong>Total</strong></td>
          <td><strong>Rp. {{ number_format($totalBeli) }}</strong></td>
          <td></td>
      </table>

  @endif
    
  <div class="clearfix"></div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#suplier').select2();
        });

        $(document).ready(function(){
            $('#alat').select2();
        })

        $(document).ready(function(){
          $('.hapusData').on('submit',function(){
            return confirm("Apakah Item Akan Dihapus ?");
          })
       })
    </script>
@endsection