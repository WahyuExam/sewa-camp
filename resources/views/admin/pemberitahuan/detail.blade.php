<h3>Detail Pemberitahuan</h3><hr> 
<table class="table table-bordered table-hover">
  <tr>
    <td>Tanggal Pemberitahuan</td>
    <td>{{ date('d-m-Y | H:i:s',strtotime($pemberitahuan->tgl)) }}</td>
  </tr>

  <tr>
    <td>Isi</td>
    <td>{{ $pemberitahuan->isi }}</td>
  </tr>

</table>