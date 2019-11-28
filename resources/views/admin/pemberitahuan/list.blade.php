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

  <div class="modal fade" id="detailModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div id="txtHint"></div>
                <input type="hidden" name="modal_id" class="form-control" id="modal_id">
            </div>
            
            <div class="modal-footer">
              {{-- <button type="button" class="btn btn-white" data-dismiss="modal">Close</button> --}}
              <a href="/admin/pemberitahuan" class="btn btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
  </div>
 
  <table class="table table-striped table-hover">
    <th>No</th>
    <th>Tanggal Pemberitahuan</th>
    <th>Isi</th>
    <th>Aksi</th>

    @foreach($pemberitahuans as $no=>$pemberitahuan)
      <form method="get">
        <tr>
          <td>{{ ++$no }}</td>
          <td>{{ date('d-m-Y | H:i:s',strtotime($pemberitahuan->tgl)) }}</td>
          <td>{{ $pemberitahuan->isi }}</td>
          <td>
              <button type="button" class="btn btn-info fa fa-info" 
                  data-target="detailModal" data-id="{{ $pemberitahuan->id }}" 
                  data-nama="{{ $pemberitahuan->id }}" data-original-title="Dispatch">
              </button>
          </td>
        </tr>
      </form>
    @endforeach
  </table>
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
          $.get("/admin/pemberitahuan/detail/"+id, function(text) {
              $("#txtHint").html(text);
          });
          
          $('#detailModal').modal('show');

          $('#detailModal').on('hidden.bs.modal', function(){
              document.location.reload();
          })
      });
    })
  </script>
@endsection