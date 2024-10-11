@extends('layouts.app')

@push('styles')
    <style>
        .dataTables_wrapper .dataTables_processing {
            position: absolute;
            top: 15% !important;
            background: #c9f2ff;
            /* border: 1px solid black;
                                                                                                                                                                                                                                                                                                                                                                                                border-radius: 3px; */
            /* font-weight: bold; */
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manajemen Survey</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Notifikasi sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Survey</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            {{-- <form action="{{ route('survey.import_excel_survey') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mt-3">
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="inputGroupFile">
                                        <label class="custom-file-label"
                                            for="inputGroupFile">{{ __('Pilih File Excel') }}</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-warning" type="submit"><i class="fa fa-upload"
                                                aria-hidden="true"></i> {{ __('Upload') }}</button>
                                    </div>
                                </div>
                            </form> --}}
                            <a href="{{ route('survey.export_excel_survey') }}" class="mt-3 btn btn-success">
                                <i class="fas fa-file-excel"></i>
                                {{ __('Export Excel') }}
                            </a>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('surveys.create') }}" class="mt-3 btn btn-primary float-right"
                                target="_blank">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                {{ __('Tambah Survey') }}
                            </a>
                        </div>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="relawan_filter">Filter:</label>
                        <select id="relawan_filter" class="form-control" style="width: 50%;">
                            <option value="">Pilih Relawan</option>
                        </select>
                    </div>
                    <!-- Tambahkan class table-responsive untuk membuat tabel responsif -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table_user">
                            <thead class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Usia</th>
                                <th>Alamat</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>TPS</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Paslon</th>
                                <th>Domisili</th>
                                <th>Keterangan</th>
                                {{-- <th>Aksi</th> --}}
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {

            $('#relawan_filter').select2({
                placeholder: "-- Cari Relawan --",
                ajax: {
                    url: "{{ route('relawan.search') }}", // Ganti dengan rute yang mengembalikan data relawan
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term // query term
                        };
                    },
                    processResults: function(data) {
                        // Tambahkan log ini untuk melihat hasil di Console
                        console.log(data);

                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.nama + ' | ' + item.relawan_wilayah
                                        .nama_kelurahan + ' | RT ' +
                                        item
                                        .rt + ' | RW ' + item.rw + ' |'
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#relawan_filter').on('change', function() {
                var relawanId = $(this).val();
                console.log("Relawan selected: ", relawanId); // Cek nilai yang dipilih
                table.ajax.url("{{ route('survey_ajax.data') }}?relawan_id=" + relawanId)
                    .load(); // Tambahkan query parameter ke URL
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

            // ========== Datatable ==========
            var table = $('#table_user').DataTable({
                ordering: false,
                processing: true,
                oLanguage: {
                    sProcessing: "<div id='loader'>Loading</div >"
                },
                serverSide: true,
                ajax: {
                    url: "{{ route('survey_ajax.data') }}",
                    data: function(d) {
                        d.relawan_filter = $('#relawan_filter').val(); // Kirim nilai filter ke server
                    },
                    complete: function(jqxhr, txt_status) {
                        // console.log(JSON.stringify(jqxhr));
                        statusCodeGlobal(jqxhr.status);
                        // if status is 200
                        if (jqxhr.status == 200) {
                            $('#table_user').unblock();
                        }
                    },
                },
                columns: [{
                        data: 'DT_RowIndex', // Kolom nomor urut otomatis
                        name: 'DT_RowIndex',
                        orderable: false, // Non-aktifkan pengurutan pada kolom ini
                        searchable: false // Non-aktifkan pencarian pada kolom ini
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'usia',
                        name: 'usia'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'rt',
                        name: 'rt'
                    },
                    {
                        data: 'rw',
                        name: 'rw'
                    },
                    {
                        data: 'tps',
                        name: 'tps'
                    },
                    {
                        data: 'kode_kec',
                        name: 'kode_kec'
                    },
                    {
                        data: 'kode_kel',
                        name: 'kode_kel'
                    },
                    {
                        data: 'id_paslon',
                        name: 'id_paslon'
                    },
                    {
                        data: 'id_domisili',
                        name: 'id_domisili'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false,
                    //     className: 'text-center'
                    // },
                ],
                drawCallback: function(settings) {
                    $('#table_user').unblock();
                }
            });

            $(".dataTables_filter input")
                .off()
                .on('keyup change', function(e) {
                    if (e.keyCode == 13 || this.value == "") {
                        table.search(this.value)
                            .draw();
                    }
                });

            table.on('draw', function() {
                // console.log('Redraw occurred at: ' + new Date().getTime());
                $('#table_user').block();
            });
            // ========== Datatable ==========

        });
    </script>
@endpush
