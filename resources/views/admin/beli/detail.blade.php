<h3>Detail Pembelian Alat </h3><hr>
<table class="table table-striped">
    <th>No</th>
    <th>Alat</th>
    <th>Harga Beli</th>
    <th>Jumlah Beli</th>
    <th>Sub Total</th>

    @foreach($detailBeli as $no=>$beli)
        <tr>
            <td>{{ ++$no }}</td>
            <td>{{ $beli->nmAlat }}</td>
            <td>Rp. {{ number_format($beli->hargaBeli)}}</td>
            <td>{{ $beli->jmlBeli }}</td>
            <td>Rp. {{ number_format($beli->sub) }}</td>
        </tr>
    @endforeach

    <td colspan="4" align="right"><strong>Total</strong></td>
    <td><strong>Rp. {{ number_format($dataBeli->ttlBeli) }}</strong></td>
</table>