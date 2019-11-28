@extends('admin.layoutAdmin')

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

     <a href="/admin/kembali/{{ $kdPinjam }}/previewCetak" class="btn btn-primary" target="_blank" title="Preview">
            <span class="glyphicon glyphicon-print"> </span>
    </a>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"><h5>Data Pelanggan</h5></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <td width="15%">ID Pelanggan</td>
                        <td width="2%">:</td>
                        <td>{{ $pinjams[0]->idPelanggan }}</td>
                    </tr>

                    <tr>
                        <td>Nama Pelanggan</td>
                        <td>:</td>
                        <td>{{ $pinjams[0]->nmPelanggan }}</td>
                    </tr>

                    <tr>
                        <td>No. Telpon</td>
                        <td>:</td>
                        <td>{{ $pinjams[0]->noTelpPel }}</td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $pinjams[0]->alamatPel }}</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $pinjams[0]->email }}</td>
                    </tr>

                    <tr>
                        <td>Jaminan</td>
                        <td>:</td>
                        <td>{{ $pinjams[0]->ket }} [ {{ $pinjams[0]->noJaminan }} ]</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading"><h5>Detail Alat Yang Dikembalikan</h5></div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <th>No</th>
                    <th>Kode Alat</th>
                    <th>Nama Alat</th>
                    <th>Jumlah Pinjam</th>
                    <th>Jumlah Alat Baik</th>
                    <th>Jumlag Alat Hilang/Rusak</th>

                    @if ($rusak<>0)
                        <th>Biaya Alat Hilang/Rusak (Rp)</th>    
                        <th>Total Biaya Alat Hilang/Rusak (Rp)</th>
                    @endif
            
                    @if ($durasi > $pinjams[0]->lamaPinjam)
                        <th>Biaya Denda (Rp)</th>    
                        <th>Total Biaya Denda (Rp)</th>
                    @endif

                   
                    @foreach($pinjams as $no=>$pinjam)
                        <tr>
                            <td width="5%">{{ ++$no }}</td>
                            <td>{{ $pinjam->kdAlat }}</td>
                            <td>{{ $pinjam->nmAlat }}</td>
                            <td>{{ $pinjam->jml }}</td>
                            <td>{{ $pinjam->jmlBaik }}</td>
                            <td>{{ $pinjam->jmlRusak }}</td>

                            @if ($rusak<>0)
                                <td>{{ number_format($pinjam->biayaAlatRusak) }}</td>
                                <td>{{ number_format($pinjam->ttlDendaHilang) }}</td>
                            @endif  

                            @if ($durasi > $pinjams[0]->lamaPinjam)
                                <td>{{ number_format($pinjam->biayaDenda) }}</td>
                                <td>{{ number_format($pinjam->ttlDenda) }}</td>
                            @endif     
                        </tr>
                    @endforeach
                </table>

                <table class="table table-striped">
                    <tr>
                        <td colspan="2" align="left" width="20%">Total Item</td>
                        <td colspan="2">: {{ $item }}</td>
                    </tr>

                    <tr>
                        <td colspan="2" align="left" width="20%">Lama Peminjaman</td>
                        <td colspan="2">: {{ $pinjams[0]->lamaPinjam}} Hari</td>
                    </tr>

                    <tr>
                        <td colspan="2" align="left" width="20%">Durasi Pinjam</td>
                        <td colspan="2">: {{ $durasi }} Hari</td>
                    </tr>

                    @if ($durasi > $pinjams[0]->lamaPinjam)
                        <tr>
                            <td colspan="2" align="left" width="20%">Telat</td>

                            <td colspan="2">: {{ $lamaDenda }} Hari</td>
                        </tr>

                        <tr>
                            <td colspan="2" align="left" width="20%">Besar Denda (Rp)</td>
                            <td colspan="2">: {{ number_format($ttlDenda) }}</td>
                        </tr>
                    @endif

                    @if ($rusak<>0)
                        <tr>
                            <td colspan="2" align="left" width="20%">Denda Barang Hilang/Rusak (Rp)</td>
                            <td colspan="2">: {{ number_format($rusak) }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td colspan="2" align="left" width="20%">Total Bayar (Rp)</td>
                        <td colspan="2">: {{ number_format($totalBayar) }}</td>
                    </tr>

                </table>
            </div>
        </div>

    </div> <!-- end container -->
@endsection