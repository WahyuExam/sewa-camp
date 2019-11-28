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
@if (Session::has('alerts'))
	@foreach(Session::get('alerts') as $alert)
	  <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
	@endforeach
@endif
 
<center><h3>Laporan Penggajihan Karyawan</h3></center>
	<div class="panel panel-primary">
		<div class="panel panel-body">
			<form method="get" action="/admin/laporan/gaji/proses">
				<div class="form-group">
					<div class="row">
						<div class="col-md-3 {{ $errors->has('blnLaporan') ? 'has-error' : '' }}">
							<label class="label-control" for="blnLaporan">Bulan Laporan</label> 
							<select name="blnLaporan" class="form-control" id="bulan">
								<option value=""></option>
								<option value="1">Januari</option>
								<option value="2">Februari</option>
								<option value="3">Maret</option>
								<option value="4">April</option>
								<option value="5">Mei</option>
								<option value="6">Juni</option>
								<option value="7">Juli</option>
								<option value="8">Agustus</option>
								<option value="9">September</option>
								<option value="10">Oktober</option>
								<option value="11">Nopember</option>
								<option value="12">Desember</option>
							</select>
							{!! $errors->first('blnLaporan','<p class=help-block>:message</p>') !!}
						</div>

						<div class="col-md-3 {{ $errors->has('thnLaporan') ? 'has-error' : ''}}">
							<label class="label-control"><br></label>
							<select name="thnLaporan" class="form-control" id="tahun">
								<option value=""></option>
								<?php 
									$sekarang = date('Y');
									$sebelum  = $sekarang - 10; 
								
									for($a=$sekarang; $a>=$sebelum; $a--){
										echo "<option value='".$a."'>".$a."</option>";
									}
								?>
							</select>
							{!! $errors->first('thnLaporan','<p class=help-block>:message</p>') !!}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<input type="submit" name="proses" class="btn btn-primary" value="Proses">
						</div>
					</div>
				</div>
			</form>		
		</div>		
	</div>
<div class="clearfix"></div>
@endsection

@section('footer')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#bulan').select2();
			$('#tahun').select2();
		})
	</script>
@endsection