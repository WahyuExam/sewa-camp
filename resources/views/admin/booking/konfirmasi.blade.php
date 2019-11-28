<h3>Bukti Pembayaran</h3><hr> 
<div class="row">
    <div class="col-md-3">
        <label class="label-control">Tanggal Pembayaran</label>
        <input type="text" value="{{ date('d - m - Y', strtotime($data->tglBayar)) }}" readonly class="form-control">
    </div>

    <div class="col-md-12">
        <label class="label-control">Catatan Pelanggan</label>
        <textarea class="form-control" rows="4" readonly >{{ $data->catatan }}</textarea>
    </div>

</div>

<div class="form-group">
      <label class="label-control">Bukti Pembayaran</label><br>
      <img src="{{ asset('/storage/bukti/'.$data->fotoBukti ) }}" width="450" height="400" alt="Foto Tidak Ada" id="foto"><br>
</div>