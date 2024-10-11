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
                        <h1>Daftar DPS</h1>
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
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Daftar DPT</h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('penduduks.create') }}" class="mt-3 btn btn-primary float-right"
                                target="_blank">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                {{ __('Tambah DPT') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <div class="row">
                        <div class="col-9">
                            <form action="{{ route('penduduk.import_excel_penduduk') }}" method="POST"
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
                            </form>
                            <a href="{{ route('penduduk.export_excel_penduduk') }}" class="mt-3 btn btn-success">
                                <i class="fas fa-file-excel"></i>
                                {{ __('Export Excel') }}
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('penduduks.create') }}" class="mt-3 btn btn-primary float-right">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                {{ __('Tambah DPT') }}
                            </a>
                        </div>
                    </div> --}}

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

            // ========== Datatable ==========
            var table = $('#table_user').DataTable({
                ordering: false,
                processing: true,
                oLanguage: {
                    sProcessing: "<div id='loader'>Loading</div >"
                },
                serverSide: true,
                ajax: {
                    url: "{{ route('penduduk_ajax.data') }}",
                    complete: function(jqxhr, txt_status) {
                        // console.log(JSON.stringify(jqxhr));
                        statusCodeGlobal(jqxhr.status);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex', // Kolom nomor urut otomatis
                        name: 'DT_RowIndex',
                        orderable: false, // Non-aktifkan pengurutan pada kolom ini
                        searchable: false // Non-aktifkan pencarian pada kolom ini
                    },
                    {
                        data: 'nama',
                        name: 'nama',
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
                ]
            });

            $(".dataTables_filter input")
                .off()
                .on('keyup change', function(e) {
                    if (e.keyCode == 13 || this.value == "") {
                        table.search(this.value)
                            .draw();
                    }
                });
            // ========== Datatable ==========

        });
    </script>
@endpush
