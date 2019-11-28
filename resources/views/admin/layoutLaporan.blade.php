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
          
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
           
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
             
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
     
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        
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