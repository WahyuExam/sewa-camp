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

    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row top_tiles">
                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-sign-in"></i></div>
                      <div class="count">Rp. {{ $ttlPendapatan<>NULL ? number_format($ttlPendapatan) : '0' }}</div>
                      <p>Pendapataan</p>
                    </div>
                  </div>

                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-sign-out"></i></div>
                      <div class="count">Rp. {{ $ttlPengeluaran<>NULL ? number_format($ttlPengeluaran) : '0' }}</div>
                      <p>Pengeluaran</p>
                    </div>
                  </div>    

                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-money"></i></div>
                      <div class="count">Rp. {{ number_format($ttlPendapatan - $ttlPengeluaran) }}</div>
                      <p>Laba / Rugi</p>
                    </div>
                  </div>    
            </div>

            <div class="row top_tiles">
                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-user"></i></div>
                      <div class="count">{{ $jmlKaryawan->jumlahKaryawan<>NULL ? $jmlKaryawan->jumlahKaryawan : '0' }} Orang</div>
                      <p>Karyawan</p>
                    </div>
                  </div>

                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-user"></i></div>
                      <div class="count">{{ $jmlPelanggan->jumlahPelanggan<>NULL ? $jmlPelanggan->jumlahPelanggan : '0' }} Orang</div>
                      <p>Pelanggan</p>
                    </div>
                  </div>    

                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-user"></i></div>
                      <div class="count">{{ $jmlSuplier->jumlahSuplier<>NULL ? $jmlSuplier->jumlahSuplier : '0' }} Orang</div>
                      <p>Suplier</p>
                    </div>
                  </div>
            </div>

            <div class="row top_tiles">
                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-tag"></i></div>
                      <div class="count">{{ $jmlALat->jumlahStok<>NULL ? $jmlALat->jumlahStok : '0'  }} Buah</div>
                      <p>Stok</p>
                    </div>
                  </div>

                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-tag"></i></div>
                      <div class="count">{{ $jmlPinjam->jumlahPinjam<>NULL ? $jmlPinjam->jumlahPinjam : '0' }} Buah</div>
                      <p>Alat Dipinjam</p>
                    </div>
                  </div>    

                  <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-tag"></i></div>
                      <div class="count">{{ $jmlRusak->jumlahRusak<>NULL ? $jmlRusak->jumlahRusak : '0'  }} Buah</div>
                      <p>Alat Rusak</p>
                    </div>
                  </div>
            </div>           
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"><h5>List Top Alat</h5></div>
        <div class="panel-body">
            <table class="table table-striped">
                <th>No</th><th>Kode Alat</th><th>Nama Alat</th><th>Jumlah Dipinjam</th>
                
                @foreach($topAlat as $no=>$top)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $top->kdAlat }}</td>
                        <td>{{ $top->nmAlat }}</td>
                        <td>{{ $top->jumlahPinjam }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

	<div class="clearfix"></div>
@endsection

