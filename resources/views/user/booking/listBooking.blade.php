@extends('user.layoutUser')

@section('content')
  <div class="container">
      @if (Session::has('alerts'))
        @foreach(Session::get('alerts') as $alert)
          <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
        @endforeach
      @endif

      @if (!empty(session('idSewa')))
          <a href="/user/booking/listalat/{{ session('idSewa') }}" class="btn btn-success">Kembali Ke Menu Utama</a><br><br>
      @else
          <a href="/" class="btn btn-success">Kembali Ke Menu Utama</a><br><br>
      @endif

      <table class="table table-striped table-hover">
        <th>No</th>
        <th>Kode Pinjam</th>
        <th>Tanggal Booking</th>
        <th>Status</th>
        <th>Durasi</th>
        <th width="30%">Action</th>
    
        @foreach($listBooking as $no=>$booking)
            <form method="get" action="/user/booking/{{ $booking->kdPinjam }}/Batal" class="hapusData">
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $booking->kdPinjam }}</td>
                    <td>{{ date('d-m-Y', strtotime($booking->tglPinjam)) }}</td>
                    <td>{{ $booking->statusSewa==1 ? 'Booking' : ' - ' }}</td>
                    <td>
                      <?php
                          date_default_timezone_set('Asia/Makassar');
                          $awal     = date_create($booking->tglPinjam);
                          $akhir    = date_create(); // waktu sekarang
                          $diff     = date_diff( $awal, $akhir );   
                          if ($diff->h==0){
                            $durasi   = '-';
                          }
                          else{
                            $durasi = $diff->h.' Jam '.$diff->i.' Menit';
                          };
                       ?>
                       {{ $durasi }}
                    </td>
                    <td> 
                        @if ($booking->statusBayar==0)                       
                            <button type="submit" class="btn btn-danger">Batalkan Proses</button>
                            <a href="/user/konfirmasi/{{ $booking->kdPinjam }}" class="btn btn-primary">Konfirmasi Pembayaran</a>
                        @else
                            <label class="btn btn-success">Konfirmasi Sukses</label>
                        @endif
                    </td>
                </tr>
            </form>
        @endforeach
      </table>
      <p>* Batas Waktu Booking hanya 2 Jam Lebih Dari Itu Data booking Akan Dihapus Dari Sistem</p>

      <div class="clearfix"></div>
  </div>
@endsection

@section('footer')
  <script>
    $(document).ready(function(){
      $('.hapusData').on('submit',function(){
        return confirm("Apakah Proses Akan Dibatalkan ?");
      })
    })
  </script>
@endsection