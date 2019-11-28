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
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode Sewa / Nama Pelanggan" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <table class="table table-striped table-hover">
    	<th>No</th>
    	<th>Kode Sewa</th>
    	<th>Tanggal Booking</th>
      <th>Nama Pelanggan</th>
    	<th>Status</th>
      {{-- <th>Durasi</th> --}} 
      <th width="10%">Status Bayar</th>
    	<th>Action</th>

    	@foreach($listBooking as $no=>$booking)
      		<form method="get" action="/admin/booking/{{ $booking->kdPinjam }}/batal" class="hapusData">
    	    		<tr>
                  <td>{{ ++$no }}</td>
                  <td>{{ $booking->kdPinjam }}</td>
                  <td>{{ date('d-m-Y',strtotime($booking->tglPinjam)) }}</td>
                  <td>{{ $booking->nmPelanggan }}</td>
                  <td>{{ $booking->statusSewa==1 ? 'Booking' : 'Tanpa Keterangan' }}</td>
                  {{-- <td> --}}
                      <?php
                          // date_default_timezone_set('Asia/Makassar');
                          // $awal     = date_create($booking->tglPinjam);
                          // $akhir    = date_create(); // waktu sekarang
                          // $diff     = date_diff( $awal, $akhir );   
                          
                          // if ($diff->h==0){
                          //   $durasi   = '-';
                          // }
                          // else{
                          //   $durasi = $diff->h.' Jam '.$diff->i.' Menit';
                          // };
                       ?>
                       {{-- {{ $durasi }} --}}
                  {{-- </td> --}}

                  <td>
                    @if ($booking->statusBayar==0)
                        Belum Dibayar
                    @else
                          <button type="button" class="btn btn-info" 
                              data-target="detailModal" data-id="{{ $booking->kdPinjam }}" 
                              data-nama="{{ $booking->kdPinjam }}" data-original-title="Dispatch" title="Bukti Pembayaran">Sudah Dibayar
                          </button>
                    @endif
                  </td>
                  
                  <td>
                    @if ($booking->statusSewa==1)
                        @if($booking->statusBayar==0)
                            <button class="btn btn-danger" title="Batalkan Peminjaman">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        @else
                            <a href="/admin/booking/{{ $booking->kdPinjam }}/proses" class="btn btn-success"> Proses Pinjam</a>
                        @endif                      
                    @else
                        <button class="btn btn-danger" title="Batalkan Peminjaman">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    @endif
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
      })

       $('.btn-info').click(function(event){
          $('#modal_id').val(event.target.dataset.id);
          
          var id = document.getElementById('modal_id').value;
          console.log(id);
          $.get("/admin/konfirmasiDetail/"+id, function(text) {
              $("#txtHint").html(text);
          });
          
          $('#detailModal').modal('show');
      });

    })
  </script>
@endsection