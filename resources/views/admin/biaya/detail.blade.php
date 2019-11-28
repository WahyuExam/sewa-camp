<h3>Detail Biaya Operasional</h3><hr> 
<table class="table table-striped table-hover">
  	<th>No</th>
  	<th>Keterangan Operasional</th>
  	<th>Biaya Operasional</th>

  	@foreach($listDetail as $no=>$detail)
  			<tr>
      			<td>{{ ++$no }}</td>
      			<td>{{ $detail->ket }}</td>
      			<td>Rp. {{ number_format($detail->biaya) }}</td>
    		</tr>
  	@endforeach

    <tr>
        <td></td>
        <td colspan="1" align="right"><strong>Total Biaya</strong></td>
        <td><strong>Rp. {{ number_format($dataBiaya->biayaOperasional) }}</strong></td>
    </tr>
</table>