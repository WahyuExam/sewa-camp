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

<center><h3>Laporan Pembelian Peralatan Bulan {{ $bln }} Tahun {{ $thn }}</h3></center>
	<p>
		<a href="/admin/laporan/pembelian/{{ $bulan }}/previewSemua" class="btn btn-primary" target="_blank" title="Preview">
		  <span class="glyphicon glyphicon-print"> </span>
		</a>

		<a href="/admin/laporan/pembelian/form" class="btn btn-default">Kembali</a>
	</p>

	<table class="table table-striped">
	    <th>No</th>
	    <th>Kode Pembelian</th>
	    <th>tanggal Pembelian</th>
	    <th>Suplier</th>
	  	<th>Total Pembelian</th>
	  	<th></th>

	  	@foreach($lists as $no=>$list)
	  		<tr> 
	  			<td>{{ ++$no }}</td>
	  			<td>{{ $list->kdBeli }}</td>
	  			<td>{{ date('d - m  - Y',strtotime($list->tglBeli)) }}</td>
	  			<td>{{ $list->nmSuplier}}</td>
	  			<td>Rp. {{ number_format($list->ttlBeli) }}</td>
	  			<td>
	  				<a href="/admin/laporan/pembelian/{{ $list->id }}/previewDetail" class="btn btn-default" target="_blank" title="Laporan Perdetail">
					  <span class="glyphicon glyphicon-print"> </span>
					</a>
	  			</td>
	  		</tr>
	  	@endforeach

	  	<tr>
	  		<td colspan="4" align="right">Total Pembelian</td>
	  		<td colspan="2">Rp.{{number_format($total)}}</td>
	  	</tr>
	   
	</table>
<div class="clearfix"></div>
@endsection