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

<center><h3>Laporan Penyewaan Peralatan Bulan {{ $bln }} Tahun {{ $thn }}</h3></center>
	<p>
		<a href="/admin/laporan/penyewaan/{{ $bulan }}/previewSemua" class="btn btn-primary" target="_blank" title="Preview">
		  <span class="glyphicon glyphicon-print"> </span>
		</a>

		<a href="/admin/laporan/penyewaan/form" class="btn btn-default">Kembali</a>
	</p>

	<table class="table table-striped">
	    <th>No</th>
	    <th>Kode Sewa</th>
	    <th>Tangal Penyewaan</th>
	  	<th>Pelanggan / Penyewa</th>
	  	<th>Lama Penyewaan</th>
	  	<th>Status Sewa</th>
	  	<th>Biaya Sewa</th>
	  	<th></th>

	  	@foreach($lists as $no=>$list)
	  		<tr> 
	  			<td>{{ ++$no }}</td>
	  			<td>{{ $list->kdPinjam }}</td>
	  			<td>{{ date('d - m  - Y',strtotime($list->tglPinjam)) }}</td>
	  			<td>{{ $list->nmPelanggan}}</td>
	  			<td>{{ $list->lamaPinjam}} Hari</td>
	  			<td>
	  				{{ $list->statusSewa==2 ? 'Proses Pinjam' : 'Sudah Kembali' }}
	  			</td>
	  			<td>Rp. {{ number_format($list->totalBayar) }}</td>
	  			<td>
	  				<a href="/admin/laporan/penyewaan/{{ $list->kdPinjam }}/previewDetail" class="btn btn-default" target="_blank" title="Laporan Perdetail">
					  <span class="glyphicon glyphicon-print"> </span>
					</a>
	  			</td>
	  		</tr>
	  	@endforeach
	  	<tr>
	  		<td colspan="6" align="right">Total Pendapatan Penyewaan</td>
	  		<td colspan="2">Rp. {{ number_format($total) }}</td>
	  	</tr>	   
	</table>
<div class="clearfix"></div>
@endsection