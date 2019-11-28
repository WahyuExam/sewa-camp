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
            <input type="text" class="form-control" placeholder="Cari Berdasarkan Kode User / Nama User" name="q"/>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
          </div>
      </div>
  </form>

  <a href="/admin/manajemen/user" class="btn btn-primary">Tambah User</a>
  <div class="row">
      <div class="list-group">
          @foreach($users as $user)
            @if (!empty($user->pengguna))
                <div class="col-md-4">
                   <form method="get" action="/admin/manajemen/user/{{ $user->kodeUser }}/hapus" class="hapusData">  
                      <p><div class="list-group-item list-group-item-light" >
                          <table class="table table-striped">
                              <tr>
                                  <td width="30%">Kode User</td><td width="5%">:</td>
                                  <td>{{ $user->kodeUser }}</td>
                              </tr>

                              <tr>
                                  <td>Nama User</td><td>:</td>
                                  <td>
                                      {{ $user->nmPelanggan=='' ? $user->nmKaryawan : $user->nmPelanggan }}
                                  </td>
                                </tr>

                              <tr>
                                  <td>Status</td><td>:</td>
                                  <td>
                                      @if($user->level==1)
                                        {{ 'Super Admin (Karyawan)'}}
                                      @elseif($user->level==2)
                                        {{ 'Karyawan' }}
                                      @else
                                        {{ 'Pelanggan' }}
                                      @endif                                  
                                  </td>
                              </tr>

                              <tr>
                                  <td>Pengguna</td><td>:</td>
                                  <td>{{ $user->pengguna }}</td>
                              </tr>
                          </table><hr>

                          <p>
                              <a href="/admin/manajemen/user/{{ $user->kodeUser }}/reset" class="btn btn-primary" title="Reset Sandi">
                                  <span class="fa fa-edit"></span>
                              </a>
    
<!--                               <button type="submit" class="btn btn-danger" title="Hapus">
                                  <span class="fa fa-trash"></span>
                              </button> -->
                          </p>
                      </div></p>
                  </form>
                </div>
            @endif
          @endforeach
      </div>
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