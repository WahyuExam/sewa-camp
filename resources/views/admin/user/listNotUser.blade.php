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
  <br><br><br><br>
  @if (Session::has('alerts'))
    @foreach(Session::get('alerts') as $alert)
      <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
    @endforeach
  @endif

  {{-- pencarian --}}
  <form class="row" style="margin-bottom: 20px">
      <div class="col-md-12">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama User" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
  </form>

  <div class="row">
      <div class="list-group">
          @foreach($users as $user)
              <div class="col-md-4">
                  <p><div class="list-group-item list-group-item-light" >
                      <table class="table table-striped">
                          <tr>
                              @if($user->idKaryawan<>NULL)
                                <td width="50%">Kode Karyawan</td><td width="3%">:</td>
                                <td>{{ $user->idKaryawan }}</td>

                              @else
                                <td width="50%">Kode Pelanggan</td><td width="3%">:</td>
                                <td>{{ $user->idPelanggan }}</td>
                              @endif
                          </tr>


                          <tr>
                              @if($user->idKaryawan<>NULL)
                                <td width="50%">Nama Karyawan</td><td width="3%">:</td>
                                <td> {{ $user->nmKaryawan }}</td>
                              @else
                                <td width="50%">Nama Pelanggan</td><td width="3%">:</td>
                                <td> {{ $user->nmPelanggan}}</td>
                              @endif
                          </tr>

                      </table>

                      <p>
                          @if($user->idKaryawan<>NULL)
                                <a href="/admin/manajemen/user/{{ $user->idKaryawan }}/setPass" class="btn btn-primary" title="Seting Sandi">
                                   <span class="fa fa-edit"></span>
                               </a>
                          @else
                               <a href="/admin/manajemen/user/{{ $user->idPelanggan }}/setPass" class="btn btn-primary" title="Seting Sandi">
                                  <span class="fa fa-edit"></span>
                              </a>
                          @endif
                      </p>
                  </div></p>
              </div>
          @endforeach
      </div>
  </div>

	<div class="clearfix"></div>
@endsection