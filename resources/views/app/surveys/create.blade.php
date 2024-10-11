@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Form Survey</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Survey</a></li>
                            <li class="breadcrumb-item active">Tambah Survey</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {{-- <div class="card"> --}}
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data Survey</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('surveys.update') }}" method="POST">
                                @csrf
                                {{-- @method('PUT') --}}
                                @include('app.surveys._form')

                                <div class="form-group text-center">

                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save"></i>
                                        {{ __('Save') }}</button>

                                    <a href="{{ route('surveys.index') }}" class="btn btn-danger" role="button"><i
                                            class="fas fa-times"></i> {{ __('Cancel') }}</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Inisialisasi Select2 dengan AJAX
            $('#FormControlSelect2').select2({
                placeholder: "-- Cari NIK --",
                ajax: {
                    url: "{{ route('penduduk.search') }}", // Sesuaikan dengan route Anda
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            penduduk: params.term // istilah pencarian
                        };
                    },
                    processResults: function(data) {
                        // console.log(data);
                        return {
                            results: $.map(data, function(item) {
                                // console.log(item);
                                return {
                                    text: item.nik + ' - ' + item
                                        .nama, // Teks yang akan ditampilkan
                                    id: item.nik // Nilai value yang akan digunakan
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            // Sesuaikan tinggi Select2 dengan input text
            $('.select2-container .select2-selection--single').css({
                'height': 'calc(1.5em + 0.75rem + 2px)',
                'display': 'flex',
                'align-items': 'center',
                'position': 'relative' // Agar ikon baru bisa diposisikan di dalam elemen
            });

            // Sembunyikan ikon segitiga bawaan Select2
            $('.select2-container--default .select2-selection--single .select2-selection__arrow').css({
                'display': 'none'
            });

            // Tambahkan ikon baru (menggunakan FontAwesome) di dalam elemen Select2
            $('.select2-container .select2-selection--single').append(
                '<i class="fas fa-chevron-down" style="position:absolute; right:5px; top:50%; transform:translateY(-50%); pointer-events:none; font-size:0.70rem;"></i>'
            );

            $("#FormControlSelect2").change(function() {
                console.log("The text has been changed." + ($(this).val()));

                $.ajax({
                    type: 'get',
                    url: "{{ route('penduduk.getbynik') }}",
                    data: {
                        nik: $(this).val()
                    },
                    dataType: 'json',
                    complete: function(jqxhr, txt_status) {
                        // console.log(JSON.stringify(jqxhr));
                        statusCodeGlobal(jqxhr.status);
                    },
                }).done(function(data, textStatus, jqXHR) {
                    console.log(data);
                    // Process data, as received in data parameter

                    // Isi data ke dalam form
                    $('#name').val(data[0].nama);
                    $('#jenis_kelamin').val(data[0].jenis_kelamin);
                    $('#rt').val(data[0].rt);
                    $('#rw').val(data[0].rw);
                    $('#tps').val(data[0].tps);
                    $('#usia').val(data[0].usia);
                    $('#alamat').val(data[0].alamat);
                    $('#kode_kec').val(data[0].kode_kec);
                    $('#kode_kel').val(data[0].kode_kel);

                    // show success message
                    iziToast.success({
                        timeout: 2000,
                        title: 'Berhasil',
                        message: 'data DPT berhasil diinput',
                        position: 'topRight',
                    });
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    // Request failed. Show error message to user.
                    // errorThrown has error message, or 'timeout' in case of timeout.
                });
            });
        });
    </script>

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            // Inisialisasi Select2 dengan AJAX
            $('#FormControlSelect2').select2({
                placeholder: "-- Cari NIK --",
                ajax: {
                    url: "{{ route('penduduk.search') }}", // Sesuaikan dengan route Anda
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            penduduk: params.term // istilah pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nik + ' - ' + item
                                        .name, // Teks yang akan ditampilkan
                                    id: item.nik // Nilai value yang akan digunakan
                                }
                            })
                        };
                    },
                    success: function(respon) {
                        console.log(respon);
                        $('#name').val(respon[0].name)
                        $('#jenis_kelamin').val(respon[0].jenis_kelamin)
                        $('#rt').val(respon[0].rt)
                        $('#rw').val(respon[0].rw)
                        $('#tps').val(respon[0].tps)
                        $('#usia').val(respon[0].usia)
                        $('#alamat').val(respon[0].alamat)
                        $('#kode_kec').val(respon[0].kode_kec)
                        $('#kode_kel').val(respon[0].kode_kel)
                    },
                    cache: true
                }
            });
        });
    </script> --}}
@endpush
