@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manajemen Relawan</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">Daftar Relawan</h3>
                        </div>
                        <div class="col-md-6">
                            <button class="mt-3 btn btn-primary float-right" data-toggle="modal"
                                data-target="#modalRelawanCreate"><i class="fa fa-plus" aria-hidden="true"></i> Relawan
                                Baru</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table_relawan">
                            <thead class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Kelurahan</th>
                                <th>Lingkungan</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>Aksi</th>
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

    <!-- ========== Modal Create Relawan ========== -->
    <div class="modal fade" id="modalRelawanCreate" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalRelawanCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRelawanCreateLabel">Tambah Relawan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_create_relawan" method="POST" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="inputNama">Nama</label>
                            <input type="text" name="nama" class="form-control form-control-sm" id="inputNama"
                                placeholder="Masukkan Nama" required>
                        </div>

                        <div class="form-group">
                            <label for="inputNoHP">No HP</label>
                            <input type="text" name="no_hp" class="form-control form-control-sm" id="inputNoHP"
                                placeholder="Masukkan No HP" required>
                        </div>

                        {{-- <div class="form-group">
                            <label for="inputKodeKel">Kode Kelurahan</label>
                            <input type="text" name="kode_kel" class="form-control form-control-sm" id="inputKodeKel"
                                placeholder="Masukkan Kode Kelurahan" required>
                        </div> --}}

                        <div class="form-group">
                            <label for="kode_kel">{{ __('Kelurahan*') }}</label>
                            <select class="form-control @error('kode_kel') is-invalid @enderror" name="kode_kel"
                                id="kode_kel" required>
                                <option value="" disabled selected>{{ __('Pilih Kelurahan') }}</option>
                                @foreach ($wilayah_kelurahan as $item)
                                    <option value="{{ $item->kode_full_kel }}"
                                        {{ old('kode_kel', $data->kode_kel ?? '') == $item->kode_full_kel ? 'selected' : '' }}>
                                        {{ $item->nama_kelurahan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kode_kel')
                                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="inputKodeLingkungan">Kode Lingkungan</label>
                            <input type="text" name="kode_lingkungan" class="form-control form-control-sm"
                                id="inputKodeLingkungan" placeholder="Masukkan Kode Lingkungan" required>
                        </div> --}}

                        {{-- <div class="form-group">
                            <label for="kode_lingkungan">{{ __('Lingkungan*') }}</label>
                            <select class="form-control @error('kode_lingkungan') is-invalid @enderror"
                                name="kode_lingkungan" id="kode_lingkungan">
                                <option value="" disabled selected>{{ __('Pilih Lingkungan') }}</option>
                                @foreach ($relawan_lingkungan as $item)
                                    <option value="{{ $item->kode }}"
                                        {{ old('kode_lingkungan', $data->kode_lingkungan ?? '') == $item->kode ? 'selected' : '' }}>
                                        {{ $item->uraian }} - RT {{ $item->rt }} - RW {{ $item->rw }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kode_lingkungan')
                                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
                            @enderror
                        </div> --}}

                        <div class="form-group">
                            <label for="kode_lingkungan">{{ __('Lingkungan*') }}</label>
                            <select class="form-control @error('kode_lingkungan') is-invalid @enderror"
                                name="kode_lingkungan" id="kode_lingkungan">
                                <option value="" disabled selected>{{ __('Pilih Lingkungan') }}</option>
                                @foreach ($relawan_lingkungan as $item)
                                    <option value="{{ $item->kode }}" data-rt="{{ $item->rt }}"
                                        data-rw="{{ $item->rw }}"
                                        {{ old('kode_lingkungan', $data->kode_lingkungan ?? '') == $item->kode ? 'selected' : '' }}>
                                        {{ $item->uraian }} | RT {{ $item->rt }} | RW {{ $item->rw }}
                                        | &nbsp;
                                    </option>
                                @endforeach
                            </select>
                            @error('kode_lingkungan')
                                <small class="error invalid-feedback" role="alert">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputRT">RT</label>
                            <input type="text" name="rt" class="form-control form-control-sm" id="inputRT"
                                placeholder="Masukkan RT" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="inputRW">RW</label>
                            <input type="text" name="rw" class="form-control form-control-sm" id="inputRW"
                                placeholder="Masukkan RW" required readonly>
                        </div>

                        {{-- <div class="form-group">
                            <label for="inputRT">RT</label>
                            <input type="text" name="rt" class="form-control form-control-sm" id="inputRT"
                                placeholder="Masukkan RT" required>
                        </div>

                        <div class="form-group">
                            <label for="inputRW">RW</label>
                            <input type="text" name="rw" class="form-control form-control-sm" id="inputRW"
                                placeholder="Masukkan RW" required>
                        </div> --}}

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary btn-create-relawan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== Modal Create Relawan ========== -->

    <!-- ========== Modal Update Relawan ========== -->
    <div class="modal fade" id="modalRelawanUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalRelawanUpdateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRelawanUpdateLabel">Update Relawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_update_relawan" method="PUT" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="inputIdUpdate" value="">

                        <div class="form-group">
                            <label for="inputNamaUpdate">Nama</label>
                            <input type="text" name="nama" class="form-control form-control-sm"
                                id="inputNamaUpdate" placeholder="Masukkan Nama" required>
                        </div>

                        <div class="form-group">
                            <label for="inputNoHPUpdate">No HP</label>
                            <input type="text" name="no_hp" class="form-control form-control-sm"
                                id="inputNoHPUpdate" placeholder="Masukkan No HP" required>
                        </div>

                        <div class="form-group">
                            <label for="kode_kel_update">{{ __('Kelurahan*') }}</label>
                            <select class="form-control" name="kode_kel" id="kode_kel_update" required>
                                <option value="" disabled>{{ __('Pilih Kelurahan') }}</option>
                                @foreach ($wilayah_kelurahan as $item)
                                    <option value="{{ $item->kode_full_kel }}">
                                        {{ $item->nama_kelurahan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kode_lingkungan_update">{{ __('Lingkungan*') }}</label>
                            <select class="form-control" name="kode_lingkungan" id="kode_lingkungan_update" required>
                                <option value="" disabled>{{ __('Pilih Lingkungan') }}</option>
                                @foreach ($relawan_lingkungan as $item)
                                    <option value="{{ $item->kode }}" data-rt="{{ $item->rt }}"
                                        data-rw="{{ $item->rw }}">
                                        {{ $item->uraian }} - RT {{ $item->rt }} - RW {{ $item->rw }}
                                        | &nbsp;
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputRTUpdate">RT</label>
                            <input type="text" name="rt" class="form-control form-control-sm" id="inputRTUpdate"
                                placeholder="Masukkan RT" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="inputRWUpdate">RW</label>
                            <input type="text" name="rw" class="form-control form-control-sm" id="inputRWUpdate"
                                placeholder="Masukkan RW" required readonly>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary btn-update-relawan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== Modal Update Relawan ========== -->
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {

            // Cari lingkungan
            $('#kode_lingkungan').select2({
                placeholder: "Pilih Lingkungan",
                allowClear: true,
                dropdownParent: $('#modalRelawanCreate')
            });

            // Event listener untuk perubahan pilihan pada select
            $('#kode_lingkungan').on('change', function() {
                // Ambil data-rt dan data-rw dari option yang dipilih
                var rt = $(this).find('option:selected').data('rt');
                var rw = $(this).find('option:selected').data('rw');

                // Isi input RT dan RW dengan nilai dari lingkungan yang dipilih
                $('#inputRT').val(rt);
                $('#inputRW').val(rw);
            });

            $('#kode_lingkungan_update').select2({
                placeholder: 'Pilih Lingkungan',
                allowClear: true,
                dropdownParent: $('#modalRelawanUpdate')
            });

            // Handle dropdown change for Lingkungan to update RT and RW fields
            $('#kode_lingkungan_update').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var rt = selectedOption.data('rt');
                var rw = selectedOption.data('rw');

                $('#inputRTUpdate').val(rt);
                $('#inputRWUpdate').val(rw);
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
            var table = $('#table_relawan').DataTable({
                "ordering": false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('relawan_ajax.data') }}",
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
                    }, {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
                    },
                    {
                        data: 'kode_kel',
                        name: 'kode_kel'
                    },
                    {
                        data: 'kode_lingkungan',
                        name: 'kode_lingkungan'
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ]
            });
            // ========== Datatable ==========

            // ========== Filter Lingkungan By Kelurahan Dipilih ==========
            // Lingkungan Create
            $(document).on('change', '#kode_kel', function(e) {
                var kode_kel = $(this).val();
                console.log(kode_kel);

                // filter select data option lingkungan berdasarkan kode_kel
                var url = "{{ route('relawan_ajax.getlingkunganbykel', ':kode') }}";
                // replace url kode with kode_kel
                url = url.replace(':kode', kode_kel);
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        kode_kel: kode_kel,
                        _token: globalToken
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#kode_lingkungan').empty();
                        $.each(response, function(key, value) {
                            $('#kode_lingkungan_update').append(
                                "<option value='' disabled selected>Pilih Lingkungan</option>"
                            );
                            $('#kode_lingkungan').append('<option value="' + value
                                .kode + '" data-rt="' + value.rt +
                                '" data-rw="' +
                                value.rw + '">' + value.uraian + ' | RT ' + value
                                .rt + ' | RW ' + value.rw + '</option>');
                        });

                        // Reset Select2
                        // $('#kode_lingkungan').select2({
                        //     placeholder: 'Pilih Lingkungan',
                        //     allowClear: true,
                        //     dropdownParent: $('#modalRelawanCreate')
                        // });
                    }
                });

            });

            // Lingkungan Update
            $(document).on('change', '#kode_kel_update', function(e) {
                var kode_kel = $(this).val();
                // var kode_lingkungan = $(this).data('lingkungan-update');
                // var rt = $(this).data('rt');
                // var rw = $(this).data('rw');
                // console.log(kode_kel, kode_lingkungan, rt, rw);

                // filter select data option lingkungan berdasarkan kode_kel
                var url = "{{ route('relawan_ajax.getlingkunganbykel', ':kode') }}";
                // replace url kode with kode_kel
                url = url.replace(':kode', kode_kel);
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        kode_kel: kode_kel,
                        _token: globalToken
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('#kode_lingkungan_update').empty();
                        $.each(response, function(key, value) {
                            // console.log(key, value);

                            // var selected = '';
                            // if (value.kode == kode_lingkungan && value.kode_kel ==
                            //     kode_kel && value.rt == rt && value.rw == rw) {
                            //     selected = 'selected';
                            // }
                            $('#kode_lingkungan_update').append('<option value="' +
                                value.kode + '" data-rt="' + value.rt +
                                '" data-rw="' +
                                value.rw + '">' + value.uraian + ' | RT ' + value
                                .rt + ' | RW ' + value.rw + '</option>');
                        });
                    }
                });
            });

            function lingkunganUpdate(params) {
                var kode_kel = params.kode_kel;
                var kode_lingkungan = params.kode_lingkungan;
                var rt = params.rt;
                var rw = params.rw;
                console.log(kode_kel, kode_lingkungan, rt, rw);

                // filter select data option lingkungan berdasarkan kode_kel
                var url = "{{ route('relawan_ajax.getlingkunganbykel', ':kode') }}";
                // replace url kode with kode_kel
                url = url.replace(':kode', kode_kel);
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        kode_kel: kode_kel,
                        _token: globalToken
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('#kode_lingkungan_update').empty();
                        $.each(response, function(key, value) {
                            // console.log(key, value);

                            var selected = '';
                            if (value.kode == kode_lingkungan && value.kode_kel ==
                                kode_kel && value.rt == rt && value.rw == rw) {
                                selected = 'selected';
                            }
                            $('#kode_lingkungan_update').append('<option ' +
                                selected + ' value="' +
                                value.kode + '" data-rt="' + value.rt +
                                '" data-rw="' +
                                value.rw + '">' + value.uraian + ' | RT ' + value
                                .rt + ' | RW ' + value.rw + '</option>');
                        });
                    }
                });
            }
            // ========== Filter Lingkungan By Kelurahan Dipilih ==========

            // ========== Create Relawan ==========
            var modalCreate = $('#modalRelawanCreate');
            $('.btn-create-relawan').on('click', function(e) {
                e.preventDefault();
                $('#form_create_relawan').submit();
            });

            $('#form_create_relawan').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = `{{ route('relawan_ajax.store') }}`;
                var method = 'POST';
                var data = form.serialize();

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        modalCreate.block();
                    },
                    complete: function(jqxhr, txt_status) {
                        statusCodeGlobal(jqxhr.status);
                    },
                }).done(function(data, textStatus, jqXHR) {
                    iziToast.success({
                        timeout: 2000,
                        title: 'Berhasil',
                        message: data.message,
                        position: 'topRight',
                    });
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    // Handle error
                }).always(function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.success) {
                        modalCreate.unblock();
                        modalCreate.modal('hide');
                        table.ajax.reload();
                        form.trigger('reset');
                    }
                });
            });
            // ========== Create Relawan ==========

            // ========== Update Relawan ==========
            var modalUpdate = $('#modalRelawanUpdate');

            $(document).on('click', '.edit', function() {
                modalUpdate.modal('show');
                var data = $(this).data('single_source');
                console.log('data', data);
                // reset form update
                $('#form_update_relawan').trigger('reset');
                // $('#kode_kel_update').val(['']).trigger('change');
                // $('#kode_kel_update').removeAttr('data-lingkungan-update');
                // $('#kode_kel_update').removeAttr('data-rt');
                // $('#kode_kel_update').removeAttr('data-rw');
                // $('#kode_lingkungan_update').val(['']).trigger('change');
                lingkunganUpdate({
                    'kode_kel': data.kode_kel,
                    'kode_lingkungan': data.kode_lingkungan,
                    'rt': data.rt,
                    'rw': data.rw
                });

                // set data to form
                $('#inputIdUpdate').val(data.id);
                $('#inputNamaUpdate').val(data.nama);
                $('#inputNoHPUpdate').val(data.no_hp);
                // $('#kode_kel_update').attr({
                //     'data-lingkungan-update': data.kode_lingkungan,
                //     'data-rt': data.rt,
                //     'data-rw': data.rw
                // });
                $('#kode_kel_update').val(data.kode_kel);
                // $("#kode_lingkungan_update").select2("val", data.kode_lingkungan);
                // $('#kode_lingkungan_update').val(data.kode_lingkungan).trigger('change');
                $('#inputRTUpdate').val(data.rt);
                $('#inputRWUpdate').val(data.rw);
            });

            $('.btn-update-relawan').on('click', function(e) {
                e.preventDefault();
                $('#form_update_relawan').submit();
            });

            $('#form_update_relawan').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = `{{ route('relawan_ajax.update') }}`;
                var method = 'PUT';
                var data = form.serialize();

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        modalUpdate.block();
                    },
                    complete: function(jqxhr, txt_status) {
                        statusCodeGlobal(jqxhr.status);
                    },
                }).done(function(data, textStatus, jqXHR) {
                    iziToast.success({
                        timeout: 2000,
                        title: 'Berhasil',
                        message: data.message,
                        position: 'topRight',
                    });
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    // Handle error
                }).always(function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.success) {
                        modalUpdate.unblock();
                        modalUpdate.modal('hide');
                        table.ajax.reload();
                        form.trigger('reset');
                    }
                });
            });
            // ========== Update Relawan ==========

            // ========== Delete Relawan ==========
            $(document).on('click', '.delete', function() {
                var data = $(this).data('single_source');
                // var url = `{{ url('relawan_ajax/destroy') }}/${data.id}`;
                var url =
                    `{{ url('relawan_ajax') }}/${data.id}/destroy`; // URL harus menyertakan ID di dalamnya
                // if (confirm('Apakah Anda yakin ingin menghapus relawan ini?')) {
                //     $.ajax({
                //         type: 'DELETE',
                //         url: url,
                //         data: {
                //             _token: '{{ csrf_token() }}',
                //         },
                //         dataType: 'json',
                //         success: function(response) {
                //             iziToast.success({
                //                 timeout: 2000,
                //                 title: 'Berhasil',
                //                 message: response.message,
                //                 position: 'topRight',
                //             });
                //             table.ajax.reload();
                //         },
                //         error: function(jqXHR, textStatus, errorThrown) {
                //             // Handle error
                //         }
                //     });
                // }
                iziToast.question({
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Info',
                    message: 'Yakin untuk menghapus data ini?',
                    position: 'center',
                    buttons: [
                        ['<button><b>Ya</b></button>', function(instance, toast) {

                            instance.hide({
                                transitionOut: 'fadeOut'
                            }, toast, 'button');

                            $.ajax({
                                type: "DELETE",
                                url: url,
                                data: {
                                    "_token": globalToken
                                },
                                beforeSend: function() {
                                    // table.block();
                                },
                                complete: function(jqxhr, txt_status) {
                                    // console.log(JSON.stringify(jqxhr));
                                    statusCodeGlobal(jqxhr.status);
                                }
                            }).done(function(data, textStatus, jqXHR) {
                                // Process data, as received in data parameter
                                // show success message
                                iziToast.success({
                                    timeout: 2000,
                                    title: 'Sukses',
                                    message: data.message,
                                    position: 'topRight',
                                });
                            }).fail(function(jqXHR, textStatus,
                                errorThrown) {
                                // Request failed. Show error message to user.
                                // errorThrown has error message, or 'timeout' in case of timeout.
                                var errors = objectToArray(jqXHR
                                    .responseJSON
                                    .errors);

                                return errors.forEach(element => {
                                    iziToast.error({
                                        title: 'Kesalahan',
                                        message: element[
                                            1][0],
                                        position: 'topRight',
                                    });
                                });
                            }).always(function(jqXHR, textStatus,
                                errorThrown) {
                                // Hide spinner or loader

                                // table.unblock();
                                if (textStatus == 'success') {
                                    table.ajax.reload();
                                }
                            });

                        }, true],
                        ['<button>Batal</button>', function(instance, toast) {

                            instance.hide({
                                transitionOut: 'fadeOut'
                            }, toast, 'button');
                            // table.unblock();

                        }],
                    ],
                });
            });
            // ========== Delete Relawan ==========

        });
    </script>
@endpush
