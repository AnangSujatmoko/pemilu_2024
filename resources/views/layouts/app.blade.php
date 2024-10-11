<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DPS Pemilu | Dashboard</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/app/dist/css/adminlte.min.css') }}">
    <!-- IziToast -->
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/iziToast-master/dist/css/iziToast.min.css') }}">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/app/custom/css/styles.css') }}">

    @isset($HeadSource)
        @foreach ($HeadSource as $item)
            <link rel="stylesheet" href="{{ $item }}">
        @endforeach
    @endisset

    @stack('styles')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.components.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        {{-- <div class="container-fluid"> --}}
        @yield('content')
        {{-- </div> --}}
        <!-- /.content-wrapper -->

        {{-- <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer> --}}

        <!-- Control Sidebar -->
        {{-- <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside> --}}
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/app/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/app/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/app/dist/js/adminlte.min.js') }}"></script>
    <!-- iziToast -->
    <script src="{{ asset('assets/app/plugins/iziToast-master/dist/js/iziToast.min.js') }}"></script>


    @isset($JsSource)
        @foreach ($JsSource as $item)
            <script src="{{ $item }}"></script>
        @endforeach
    @endisset

    <script>
        var globalToken = $("meta[name='csrf-token']").attr("content");

        function objectToArray(data) {
            return Object.keys(data).map((key) => [key, data[key]]);
        }

        function statusCodeGlobal(code) {
            switch (code) {
                case 403:
                    iziToast.warning({
                        timeout: 5000,
                        title: 'Peringatan',
                        message: 'Akses tidak diizinkan. silahkan refresh halaman atau login kembali',
                        position: 'topRight',
                    });
                    break;
                case 404:
                    iziToast.warning({
                        timeout: 5000,
                        title: 'Peringatan',
                        message: 'Halaman atau Rute tidak ditemukan. silahkan kembali',
                        position: 'topRight',
                    });
                    break;
                case 419:
                    iziToast.warning({
                        timeout: 5000,
                        title: 'Peringatan',
                        message: 'Sesi anda telah habis/berakhir. silahkan login kembali',
                        position: 'topRight',
                    });
                    break;
                case 500:
                    iziToast.warning({
                        timeout: 5000,
                        title: 'Peringatan',
                        message: 'Terjadi kesalahan pada server. silahkan hubungi developer untuk maintenance',
                        position: 'topRight',
                    });
                    break;
                default:
                    break;
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
