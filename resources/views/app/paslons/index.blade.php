@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Paslon</h1>
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
                            <h4 class="card-title">Daftar Paslon</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tambahkan class table-responsive untuk membuat tabel responsif -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table_user">
                            <thead class="text-center">
                                <th style="width: 50px;">No</th>
                                <th>Uraian</th>
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
                "ordering": false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('paslon_ajax.data') }}",
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
                        data: 'uraian',
                        name: 'uraian',
                    },
                ]
            });
            // ========== Datatable ==========

        });
    </script>
@endpush
