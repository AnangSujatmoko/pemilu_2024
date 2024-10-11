<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HSSE | 403 Page not found </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/app') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/app') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/app') }}/dist/css/adminlte.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/app') }}/dist/css/style.css"> --}}

</head>

<body class="hold-transition login-page" id="grad">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="kartu card-outline card-primary shadow kotakEfek">

            <div class="card-body">
                <!-- Content Header (Page header) -->





                <div class="error-content tengah">
                    {{-- <img src="{{ asset('assets/app') }}/dist/img/404.png"> --}}
                    <h3><i class="fas fa-exclamation-triangle iconMerah"></i> Oops!</h3>

                    <p>
                        Anda tidak punya akses atas Halaman ini. Silahkan kembali ke <a
                            href="{{ route('home') }}">dashboard</a>
                    </p>

                    {{-- <form class="search-form">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-warning lebihDetail"><i
                                        class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.input-group -->
                    </form> --}}
                </div>
                <!-- /.error-content -->



            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/app') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/app') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/app') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
