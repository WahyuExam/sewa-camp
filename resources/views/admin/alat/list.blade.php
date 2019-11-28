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

	{{-- pencarian --}}
	<form class="row" style="margin-bottom: 20px">
      <div class="col-md-12">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode / Nama Alat" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
    </form>

    <a href="/admin/alat/form" class="btn btn-primary">Tambah Data</a>

    <div class="row">
        @foreach($listAlat as $alat)
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $alat->kdAlat }}</div>
                    <div class="panel-body">
                        <img src="{{ asset('/storage/fotoAlat/'.$alat->fotoAlat) }}" width="225px" height="200px">
                        {{ $alat->nmAlat }}<br>
                        {{ $alat->merkAlat }}<br>
                    </div>

                    <div class="panel-footer">
                        <form method="get" action="/admin/alat/{{ $alat->id }}/hapus" class="hapusData">
                            <a href="/admin/alat/{{ $alat->id }}/edit" class="btn btn-info btn-sm">
                              <span class="fa fa-edit"></span>
                            </a>
              
                            <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                      </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  

    <div class="pull-right">
    	{!! $listAlat->render() !!}
    </div>
	<div class="clearfix"></div>
@endsection

@section('footer')
  <script>
    $(document).ready(function(){
      $('.hapusData').on('submit',function(){
        return confirm("Apakah Data Akan Dihapus ?");
      })
    })
  </script>
@endsection