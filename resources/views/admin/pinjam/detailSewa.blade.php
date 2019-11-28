@extends('admin.layoutPinjam')

@section('content')
	<div class="container">
        <br><br><br><br>
        @if (Session::has('alerts'))
            @foreach(Session::get('alerts') as $alert)
              <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
            @endforeach
        @endif

        <div class="panel panel-primary">
            <div class="panel-heading"><h5>Detail Alat Yang Dipinjam</h5></div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <th>No</th>
                    <th>Kode Alat</th>
                    <th>Nama Alat</th>
                    <th>Biaya Sewa</th>
                    <th>Jumlah Pinjam</th>
                    <th>Total Biaya Pinjam</th>
                    <th>Action</th>

                    @foreach($keranjangs as $no=>$keranjang)
                        <tr>
                            <td width="5%">{{ ++$no }}</td>
                            <td>{{ $keranjang->kdAlat }}</td>
                            <td width="45%">{{ $keranjang->nmAlat }}</td>
                            <td>{{ number_format($keranjang->biayaSewa) }}</td>
                            <td>{{ $keranjang->jml }}</td>
                            <td>{{ number_format($keranjang->ttlBiaya) }}</td>
                            <td width="13%">
                              
                              @if (session('jmlKeranjang')<>0)
                                  <form method="get" action="/admin/pinjam/keranjang/{{ $keranjang->pinjamId }}/{{ $keranjang->alatId }}/hapus" class="hapusData">

                                      <a href="/admin/pinjam/keranjang/{{ $keranjang->pinjamId }}/{{ $keranjang->alatId }}/edit" class="btn btn-primary btn-sm" title="Ubah Jumlah">
                                          <span class="glyphicon glyphicon-pencil"></span>
                                      </a>
                                      
                                      <button class="btn btn-danger btn-sm" type="submit" title="Hapus Item" >
                                        <span class="glyphicon glyphicon-trash"></span>
                                      </button>
                                  </form>
                              @endif
                            </td>        
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="right">Total Item</td>
                        <td colspan="2">{{ session('jmlKeranjang') }}</td>
                    </tr>

                    <tr>
                        <td colspan="5" align="right">Lama Peminjaman (Hari)</td>
                        <td colspan="2">{{ $keranjangs[0]->lamaPinjam}}</td>
                    </tr>

                    <tr>
                        <td colspan="5" align="right">Grand Total Biaya (Rp)</td>
                        <td colspan="2">{{ number_format($total) }}</td>
                    </tr>
                </table>

                <form method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if (session('jmlKeranjang')<>0)
                        <input type="submit" class="btn btn-primary" value="Simpan Transaksi">
                    @endif
                    <a href="/admin/pinjam/listalat/{{ $keranjangs[0]->kdPinjam }}" class="btn btn-danger">Kembali Ke List Peralatan</a>

                    <input type="hidden" name="total" value="{{ $total }}">
                </form>
            </div>
        </div>

    </div> <!-- end container -->
@endsection

@section('footer')
  <script>
    $(document).ready(function(){
        $('.hapusData').on('submit',function(){
            return confirm("Apakah Item Akan Dihapus ?");
         });
    })
  </script>
@endsection