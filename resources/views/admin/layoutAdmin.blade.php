<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>Aplikasi Penyewaan Alat Camping  </title>

    <!-- Bootstrap -->
    <link href="{{ asset('gentella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('gentella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('gentella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('gentella/build/css/custom.min.css')}}" rel="stylesheet">

    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    
    {{-- <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}"> --}}

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col"> 
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> 
                  @if (session('auth')->level==1)
                      <span>Admin Aplikasi</span>
                  @elseif(session('auth')->level==2)
                      <span>Karyawan</span>
                  @endif
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                @if ((session('auth')->level == 1) or (session('auth')->level == 2))
                    <img src="{{ asset('/storage/fotoKaryawan/'.session('auth')->fotoKaryawan ) }}" alt="..." class="img-circle profile_img">
                @else
                    <img src="{{ asset('foto/foto.png') }}" alt="..." class="img-circle profile_img">
                @endif

              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ session('auth')->nmKaryawan == '' ? session('auth')->nmPelanggan : session('auth')->nmKaryawan  }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">  
                  <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard </a>

                  <li><a><i class="fa fa-home"></i> Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/admin/alat/list">Alat</a></li>
                      <li><a href="/admin/suplier/list">Supplier</a></li>
                      <li><a href="/admin/karyawan/list">Karyawan</a></li>
                      <li><a href="/admin/pelanggan/list">Pelanggan</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/admin/booking/list">Booking</a></li>
                      <li><a href="/admin/pinjam/list/{{ date('Y-m-d') }}">Penyewaan Alat</a></li>
                      <li><a href="/admin/kembali/list/{{ date('Y-m-d') }}">Pengembalian Alat</a></li>
                      <li><a href="/admin/stok/list">Manajemen Stok & Biaya Sewa</a></li>
                      <li><a href="/admin/beli/list/{{ date('Y-m-d') }}">Pembelian Alat</a></li>
                      <li><a href="/admin/biaya/list/{{ date('Y-m-d') }}">Biaya Operasional</a></li>
                      <li><a href="/admin/gaji/list/{{ date('Y-m') }}">Penggajihan Karyawan</a></li>
                      <li><a href="/admin/alatrusak/list/{{ date('Y-m') }}">Alat Rusak</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/admin/laporan/alat/form">Alat</a></li>
                      <li><a href="/admin/laporan/suplier/form">Supplier</a></li>
                      <li><a href="/admin/laporan/karyawan/form">Karyawan</a></li>
                      <li><a href="/admin/laporan/pelanggan/form">Pelanggan</a></li>
                      <li><a href="/admin/laporan/penyewaan/form">Penyewaan Alat</a></li>
                      <li><a href="/admin/laporan/pengembalian/form">Pengembalian Alat</a></li>
                      <li><a href="/admin/laporan/pembelian/form">Pembelian Alat</a></li>
                      <li><a href="/admin/laporan/biaya/form">Biaya Operasional</a></li>
                      <li><a href="/admin/laporan/gaji/form">Penggajihan Karyawan</a></li>
                      <li><a href="/admin/laporan/labarugi/form">Laba / Rugi</a></li>
                    </ul>
                  </li>
                  
                  @if (session('auth')->level==1)
                      <li><a><i class="fa fa-table"></i> Fasilitas <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="/admin/manajemen/user/list">Manajemen User</a></li>
                        </ul>
                      </li>
                  @endif

                </ul>
              </div>
        
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
             
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                    @if ((session('auth')->level == 1) or (session('auth')->level == 2))
                        <img src="{{ asset('/storage/fotoKaryawan/'.session('auth')->fotoKaryawan ) }}" alt="...">
                    @else
                        <img src="{{ asset('foto/foto.png') }}" alt="...">
                    @endif
                    
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="/admin/gantisandi/{{ session('auth')->kodeUser }}"> Ganti Sandi</a></li>
                    <li><a href="/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              {{--   <li class="">
                    <a href="" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                       <i class="fa fa-shopping-cart -o"></i>
                       <span class="badge bg-green">6</span>
                  </a>           
                </li> --}}

                @yield('pemberitahuan');

               {{--  <li class="">
                    <a href="" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                       <i class="fa fa-laptop"   style="font-size:30px"></i>
                       <span class="badge bg-red">6</span>
                  </a>           
                </li> --}}

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>

        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('gentella/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('gentella/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('gentella/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('gentella/vendors/DateJS/build/date.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('gentella/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('gentella/build/js/custom.min.js') }}"></script>

    <!-- Custom Theme Scripts -->
    {{-- <script src="../build/js/custom.min.js"></script> --}}

    {{-- select2 --}}
    <script src="{{ asset('js/select2/select2.min.js') }}"></script>

    @yield('footer')
  </body>
</html>