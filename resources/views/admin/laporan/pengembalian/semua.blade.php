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

<center><h3>Laporan Pengembalian Peralatan Bulan {{ $bln }} Tahun {{ $thn }}</h3></center>
	<p>
		<a href="/admin/laporan/pengembalian/{{ $bulan }}/previewSemua" class="btn btn-primary" target="_blank" title="Preview">
		  <span class="glyphicon glyphicon-print"> </span>
		</a>

		<a href="/admin/laporan/pengembalian/form" class="btn btn-default">Kembali</a>
	</p>

	<table class="table table-striped">
	    <th>No</th>
	    <th>Kode Pengembalian</th>
	    <th>Kode Penyewaan</th>
	    <th>Tangal Pengembalian</th>
	  	<th>Pelanggan / Penyewa</th>
	  	<th>Denda Telat</th>
	  	<th>Denda Alat Hilang</th>
	  	<th>Total Denda</th>
	  	<th></th>

	  	@foreach($lists as $no=>$list)
	  		<tr> 
	  			<td>{{ ++$no }}</td>
	  			<td>{{ $list->kdKembali }}</td>
	  			<td>{{ $list->kdPinjam }}</td>
	  			<td>{{ date('d - m  - Y',strtotime($list->tglkembali)) }}</td>
	  			<td>{{ $list->nmPelanggan}}</td>
	  			<td>Rp.{{ number_format($list->denda) }}</td>
	  			<td>Rp.{{ number_format($list->dendaHilang) }}</td>
	  			<td>Rp.{{ number_format($list->denda + $list->dendaHilang) }}</td>
	  			<td>
	  				<a href="/admin/laporan/pengembalian/{{ $list->kdKembali }}/previewDetail" class="btn btn-default" target="_blank" title="Laporan Perdetail">
					  <span class="glyphicon glyphicon-print"> </span>
					</a>
	  			</td>
	  		</tr>
	  	@endforeach
		<td>
			<td colspan="4" align="right">Total Biaya</td>
			<td>Rp. {{ number_format($denda) }}</td>
			<td>Rp. {{ number_format($dendaHilang) }}</td>
			<td colspan="2">Rp. {{ number_format($totalDenda) }}</td>
		</td>	   
	</table>
<div class="clearfix"></div>
@endsection