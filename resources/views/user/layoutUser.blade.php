<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Aplikasi Penyewaan Peralatan Camp</title>
    <meta name="description" content="Laravel Shopping Cart Example">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Store CSRF token for AJAX calls -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/bootstrap.min.css') }}">

    @yield('extra-css')

    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <style>

        .spacer {
            margin-bottom: 100px;
        }

        .cart-image {
            width: 100px;
        }

        footer {
            background-color: #f5f5f5;
            padding: 20px 0;
        }

        .table>tbody>tr>td {
            vertical-align: middle;
        }

        .side-by-side {
            display: inline-block;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              {{-- <a class="navbar-brand" href="{{ url('/') }}">Laravel Shopping Cart Example</a> --}}
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a>Camp OutDoor</a></li>
                @if (!empty(session('kdPinjam')))
                    <li><a href="/user/booking/listalat/{{ session('kdPinjam') }}">Home</a></li>
                @else
                    <li><a href="{{ url('/') }}">Home</a></li>
                @endif


                <li><a href="/tentang">Tentang</a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/user/booking/list/{{ session('auth') ? session('auth')->id : ''  }}">
                        @if (!empty(session('auth')))
                            Booking <span class="badge badge-light">{{ session('jmlBooking') }}</span>
                        @endif
                     </a>
                </li>

                <li>
                    <a href="/user/booking/keranjang/{{ session('idSewa') ? session('idSewa') : '-'}}">
                        @if (!empty(session('auth')))
                            Keranjang <span class="badge badge-light">{{ session('jmlKeranjang') }}</span>
                        @endif
                    </a>
                </li>

                @if (empty(session('auth')))
                    <li><a href="/login">Login</a></li>
                @endif

                @if (!empty(session('auth')))
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ session('auth')->nmPelanggan }}<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="/user/ubahProfile/{{ session('auth')->kodeUser }}">Profil</a></li>
                        <li><a href="/logout">Logout</a></li>
                      </ul>
                    </li>
                @endif

              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

    </header>

    @yield('content')


</body>
    <footer>
      <div class="container">
        {{-- <p class="text-muted">By <a href="http://andremadarang.com">Andre Madarang</a></p> --}}
      </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('user/js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>


    @yield('footer')
</html>
