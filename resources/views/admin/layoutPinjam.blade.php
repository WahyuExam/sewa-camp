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
    <link href="{{ asset('gentella/build/css/custom.css')}}" rel="stylesheet">

    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    
    {{-- <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}"> --}}

  </head>

  <body class="nav-sm">
    <div class="container body">
      <div class="main_container">
        
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>

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
                </li>

                <li class="">
                    <a href="/admin/pinjam/keranjang/{{ session('idSewa') }}">
                       <i class="fa fa-shopping-cart" style="font-size:30px"></i>
                       <span class="badge bg-green">{{ session('jmlKeranjang') }}</span>
                  </a>           
                </li>
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