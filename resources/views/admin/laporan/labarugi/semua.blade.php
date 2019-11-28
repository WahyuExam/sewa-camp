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

<center><h3>Laporan Laba / Rugi Bulan {{ $bln }} Tahun {{ $thn }}</h3></center>
	<p>
		<a href="/admin/laporan/labarugi/{{ $bulan }}/previewSemua/{{ $ttlPendapatan }}/{{ $ttlPengeluaran }}" class="btn btn-primary" target="_blank" title="Preview">
		  <span class="glyphicon glyphicon-print"> </span>
		</a>

		<a href="/admin/laporan/labarugi/form" class="btn btn-default">Kembali</a>
	</p>

	<table class="table table-striped">
	    <th>No</th>
	    <th>Keterangan</th>
	    <th>Pendapatan</th>
	    <th>Pengeluaran</th>

	  	@foreach($lists as $no=>$list)
	  		<tr> 
	  			<td>{{ ++$no }}</td>
	  			<td>{{ $list->keterangan }}</td>
	  			
	  			@if ($list->pendapatan==0 || $list->pendapatan==NULL)
	  				<td> - </td>
	  			@else
	  				<td>Rp. {{ number_format($list->pendapatan) }}</td>
	  			@endif

	  			@if ($list->pengeluaran==0 || $list->pengeluaran==NULL)
	  				<td> - </td>
	  			@else
	  				<td>Rp. {{ number_format($list->pengeluaran) }}</td>
	  			@endif
	  		</tr>
	  	@endforeach
	   
	   <tr>
	   		<td colspan="2" align="right">Total</td>
	   		<td>Rp. {{ number_format($ttlPendapatan) }}</td>
	   		<td>Rp. {{ number_format($ttlPengeluaran) }}</td>
	   </tr>

	   <tr>
	   		<td colspan="2" align="right">Laba</td>
	   		<td colspan="2">{{ $ttlPendapatan - $ttlPengeluaran < 0 ? ' - ' : 'Rp. '.number_format($ttlPendapatan - $ttlPengeluaran) }}</td>
	   </tr>

	   	<tr>
	   		<td colspan="2" align="right">Rugi</td>
	   		<td colspan="2">{{ $ttlPendapatan - $ttlPengeluaran < 0 ? 'Rp. '.number_format($ttlPendapatan - $ttlPengeluaran) : ' - '  }}</td>
	   </tr>
	</table>
<div class="clearfix"></div>
@endsection