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
  <br><br><br>
  @if (Session::has('alerts'))
    @foreach(Session::get('alerts') as $alert)
      <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
    @endforeach
  @endif

  <div class="modal fade" id="detailModal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-body">
                  <div id="txtHint"></div>
                  <input type="hidden" name="modal_id" class="form-control" id="modal_id">
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>

	{{-- pencarian --}}
	<form class="row" style="margin-bottom: 20px">
      <div class="col-md-12">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode Beli" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <a href="/admin/beli/form/{{ date('Y-m-d') }}" class="btn btn-primary">Tambah Pembelian</a>

    <table class="table table-striped table-hover">
    	<th>No</th>
    	<th>Kode Beli</th>
    	<th>Tanggal Sewa</th>
    	<th>Suplier</th>
    	<th>Total Beli</th>
      <th>Action</th>

    	@foreach($listBeli as $no=>$beli)
  				<tr>
  	    			<td>{{ ++$no + $listBeli->FirstItem() - 1  }}</td>
  	    			<td>{{ $beli->kdBeli }}</td>
  	    			<td>{{ date('d-m-Y',strtotime($beli->tglBeli)) }}</td>
  	    			<td>{{ $beli->nmSuplier }}</td>
              <td>Rp. {{ number_format($beli->ttlBeli) }}</td>
              <td>
                    <button type="button" class="btn btn-info fa fa-info" 
                        data-target="detailModal" data-id="{{ $beli->id }}" 
                        data-nama="{{ $beli->id }}" data-original-title="Dispatch">
                    </button>
              </td>
	    		</tr>
    	@endforeach
    </table>

    <div class="pull-right">
    	{!! $listBeli->render() !!}
    </div>
	<div class="clearfix"></div>
@endsection

@section('footer')
  <script>
      $(document).ready(function () {
          $('.fa-info').click(function(event){
              $('#modal_id').val(event.target.dataset.id);
              
              var id = document.getElementById('modal_id').value;
              console.log(id);
              $.get("/admin/beli/detail/"+id, function(text) {
                  $("#txtHint").html(text);
              });
              
              $('#detailModal').modal('show');
          });
      });
  </script>
@endsection