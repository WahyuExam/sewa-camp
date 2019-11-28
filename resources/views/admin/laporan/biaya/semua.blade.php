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

<center><h3>Laporan Biaya Operasional Bulan {{ $bln }} Tahun {{ $thn }}</h3></center>
	<p>
		<a href="/admin/laporan/biaya/{{ $bulan }}/previewSemua" class="btn btn-primary" target="_blank" title="Preview">
		  <span class="glyphicon glyphicon-print"> </span>
		</a>

		<a href="/admin/laporan/biaya/form" class="btn btn-default">Kembali</a>
	</p>

	<table class="table table-striped">
	    <th>No</th>
	    <th>Kode Operasional</th>
	    <th>Tangal Biaya Operasional</th>
	  	<th>Biaya Operasional</th>
	  	<th></th>

	  	@foreach($lists as $no=>$list)
	  		<tr> 
	  			<td>{{ ++$no }}</td>
	  			<td>{{ $list->kdOperasional }}</td>
	  			<td>{{ date('d - m  - Y',strtotime($list->tgloperasional)) }}</td>
	  			<td>Rp.{{ number_format($list->biayaOperasional) }}</td>
	  			<td>
	  				<a href="/admin/laporan/biaya/{{ $list->id }}/previewDetail" class="btn btn-default" target="_blank" title="Laporan Perdetail">
					  <span class="glyphicon glyphicon-print"> </span>
					</a>
	  			</td>
	  		</tr>
	  	@endforeach

	  	<tr>
	  		<td colspan="3" align="right">Total Biaya Operasional</td>
	  		<td colspan="2">Rp.{{ number_format($total) }}</td>
	  	</tr>
	   
	</table>
<div class="clearfix"></div>
@endsection