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

  <a href="/admin/biaya/form/{{ date('Y-m-d') }}" class="btn btn-primary">Tambah Data</a>

  <table class="table table-striped table-hover">
  	<th>No</th>
    <th>Kode Operasional</th>
  	<th>Tgl Biaya Operasional</th>
  	<th>Biaya Operasional</th>
  	<th>Action</th>

  	@foreach($listBiaya as $no=>$biaya)
  		<form method="get" action="/admin/biaya/list/{{ $biaya->id }}/hapus" class="hapusData">
    		<tr>
    			<td>{{ ++$no }}</td>
          <td>{{ $biaya->kdOperasional }}</td>
    			<td>{{ date('d - m - Y',strtotime($biaya->tgloperasional)) }}</td>
    			<td>Rp. {{ number_format($biaya->biayaOperasional) }}</td>
    			<td>
              <button type="button" class="btn btn-info fa fa-info" 
                  data-target="detailModal" data-id="{{ $biaya->id }}" 
                  data-nama="{{ $biaya->id }}" data-original-title="Dispatch">
              </button>
            
              <button class="btn btn-danger btn-sm" type="submit" title="Hapus">
                <span class="glyphicon glyphicon-trash"></span>
              </button>
    			</td>
    		</tr>
  		</form>
  	@endforeach
  </table>

	<div class="clearfix"></div>
@endsection

@section('footer')
  <script>
    $(document).ready(function(){
      $('.hapusData').on('submit',function(){
        return confirm("Apakah Data Akan Dihapus ?");
      });

      $('.fa-info').click(function(event){
          $('#modal_id').val(event.target.dataset.id);
          
          var id = document.getElementById('modal_id').value;
          console.log(id);
          $.get("/admin/biaya/detail/"+id, function(text) {
              $("#txtHint").html(text);
          });
          
          $('#detailModal').modal('show');
      });
    })
  </script>
@endsection