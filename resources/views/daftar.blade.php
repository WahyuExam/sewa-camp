<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar User</title>

    <!-- Bootstrap -->
    <link href="{{ asset('gentella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('gentella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('gentella/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('gentella/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('gentella/build/css/custom.min.css') }}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">

            <form method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <h1>Daftar User</h1>

                @if (Session::has('alerts'))
                  @foreach(Session::get('alerts') as $alert)
                      <div class="alert alert-{{ $alert['type'] }}">{!! $alert['text'] !!}</div>
                  @endforeach
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required>
                    </div>

                    <div class="col-md-12">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>

                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Pengguna" name="pengguna" required>
                    </div>

                    <div class="col-md-12">
                        <input type="password" class="form-control" placeholder="Kata Sandi" name="sandi" required>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary form-control" value="Login" type="submit">Daftar</button>
                    </div>
                </div>

              <div class="separator">
                  Sudah Punya Akun ? <a href="/login" class="to_register">Login Disini</a>
                </p>

                <div class="clearfix"></div>
                <br />

              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>