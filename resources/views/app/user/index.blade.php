@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manajemen User</h1>
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
                            <h3 class="card-title">Daftar User</h3>
                        </div>
                        <div class="col-md-6">
                            <button class="mt-3 btn btn-primary float-right" data-toggle="modal"
                                data-target="#modalUserCreate"><i class="fa fa-plus" aria-hidden="true"></i> User
                                Baru</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover" id="table_user">
                        <thead class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>

    <!-- ========== Modal Create User ========== -->
    <div class="modal fade" id="modalUserCreate" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalUserCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserCreateLabel">Tambah User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_create_user" method="POST" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="inputName">Nama</label>
                            <input type="text" name="nama" class="form-control form-control-sm" id="inputName"
                                placeholder="Masukkan Nama.." required>
                        </div>

                        <div class="form-group">
                            <label for="inputUsername">Username</label>
                            <input type="text" name="username" class="form-control form-control-sm" id="inputUsername"
                                placeholder="Masukkan Username.." required>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" id="inputEmail"
                                placeholder="Masukkan Email.." required>
                        </div>

                        <div class="form-group">
                            <label for="selectRole">Peran</label>
                            <select name="role" class="form-control form-control-sm" id="selectRole" required>
                                <option value="" disabled selected>Pilih Peran..</option>
                                @isset($role)
                                    @foreach ($role as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="form-group" id="wilayah_operator_group">
                            <label for="selectWilayah">Wilayah Operator</label>
                            <select name="wilayah" class="form-control form-control-sm" id="selectWilayah" required>
                                <option value="" disabled selected>Pilih Wilayah..</option>
                                @isset($wilayahKecamatan)
                                    @foreach ($wilayahKecamatan as $item)
                                        <option value="{{ $item->kode_full_kec }}">{{ $item->nama_kecamatan }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control form-control-sm" id="inputPassword"
                                placeholder="Masukkan Password.." required>
                        </div>

                        <div class="form-group">
                            <label for="inputPasswordConfirm">Konfirmasi Password</label>
                            <input type="password" class="form-control form-control-sm" id="inputPasswordConfirm"
                                placeholder="Konfirmasi Password.." required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary btn-create-user">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== Modal Create User ========== -->


    <!-- ========== Modal Update User ========== -->
    <div class="modal fade" id="modalUserUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalUserUpdateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserUpdateLabel">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_update_user" method="PUT" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="inputIdUpdate" value="">

                        <div class="form-group">
                            <label for="inputNameUpdate">Nama</label>
                            <input type="text" name="nama" class="form-control form-control-sm"
                                id="inputNameUpdate" placeholder="Masukkan Nama.." required>
                        </div>

                        <div class="form-group">
                            <label for="inputUsernameUpdate">Username</label>
                            <input type="text" name="username" class="form-control form-control-sm"
                                id="inputUsernameUpdate" placeholder="Masukkan Username.." required>
                        </div>

                        <div class="form-group">
                            <label for="inputEmailUpdate">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm"
                                id="inputEmailUpdate" placeholder="Masukkan Email.." required>
                        </div>

                        <div class="form-group">
                            <label for="selectRoleUpdate">Peran</label>
                            <select name="role" class="form-control form-control-sm" id="selectRoleUpdate" required>
                                <option value="" disabled selected>Pilih Peran..</option>
                                @isset($role)
                                    @foreach ($role as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="form-group" id="wilayah_operator_group_update">
                            <label for="selectWilayahUpdate">Wilayah Operator</label>
                            <select name="wilayah" class="form-control form-control-sm" id="selectWilayahUpdate"
                                required>
                                <option value="" disabled selected>Pilih Wilayah..</option>
                                @isset($wilayahKecamatan)
                                    @foreach ($wilayahKecamatan as $item)
                                        <option value="{{ $item->kode_full_kec }}">{{ $item->nama_kecamatan }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary btn-update-user">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== Modal Update User ========== -->

    <!-- ========== Modal Update Password ========== -->
    <div class="modal fade" id="modalUserUpdatePassword" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalUserUpdatePasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserUpdatePasswordLabel">Update User ( <span
                            id="titleNameDelete"></span> )
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_update_password" method="PUT" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="inputIdDelete" value="">

                        <div class="form-group">
                            <label for="inputPasswordUpdate">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm"
                                id="inputPasswordUpdate" placeholder="Masukkan Password.." required>
                        </div>

                        <div class="form-group">
                            <label for="inputPasswordConfirmUpdate">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-sm"
                                id="inputPasswordConfirmUpdate" placeholder="Masukkan Password.." required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary btn-update-user-password">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== Modal Update Password ========== -->
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {

            // ========== Datatable ==========
            var table = $('#table_user').DataTable({
                processing: true,
                // serverSide: true,
                ajax: {
                    url: "{{ route('user_ajax.data') }}",
                    complete: function(jqxhr, txt_status) {
                        // console.log(JSON.stringify(jqxhr));
                        statusCodeGlobal(jqxhr.status);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
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


            // ========== Condition For Input Wilayah ==========
            $('#wilayah_operator_group').hide();
            // $('#wilayah_operator_group_update').hide();
            // Create Form
            $(document).on('click', '#selectRole', function(e) {
                e.preventDefault();
                // check if the text of option selected is Operator
                // console.log($(this).find(':selected').text());
                var role = $(this).val();
                // if (role === '2') {
                if ($(this).find(':selected').text() == 'Operator') {
                    $('#wilayah_operator_group').show();
                } else {
                    $('#wilayah_operator_group').hide();
                }
            });
            // Update Form
            $(document).on('click', '#selectRoleUpdate', function(e) {
                e.preventDefault();
                var role = $(this).val();
                if ($(this).find(':selected').text() == 'Operator') {
                    $('#wilayah_operator_group_update').show();
                } else {
                    $('#wilayah_operator_group_update').hide();
                }
            })
            // ========== Condition For Input Wilayah ==========


            // ========== Create User ==========
            var modalCreate = $('#modalUserCreate');
            $('.btn-create-user').on('click', function(e) {
                e.preventDefault();
                $('#form_create_user').submit();
            });

            $('#form_create_user').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();

                var url = `{{ route('user_ajax.store') }}`;

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        modalCreate.block();
                    },
                    complete: function(jqxhr, txt_status) {
                        // console.log(JSON.stringify(jqxhr));
                        statusCodeGlobal(jqxhr.status);
                    },
                }).done(function(data, textStatus, jqXHR) {
                    // Process data, as received in data parameter

                    // show success message
                    iziToast.success({
                        timeout: 2000,
                        title: 'Berhasil',
                        message: data.message,
                        position: 'topRight',
                    });
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    // Request failed. Show error message to user.
                    // errorThrown has error message, or 'timeout' in case of timeout.
                    var errors = objectToArray(jqXHR.responseJSON
                        .errors);

                    return errors.forEach(element => {
                        iziToast.error({
                            title: 'Kesalahan',
                            message: element[1][0],
                            position: 'topRight',
                        });
                    });

                }).always(function(jqXHR, textStatus, errorThrown) {
                    // Hide spinner or loader
                    // console.log(jqXHR);
                    modalCreate.unblock();
                    if (jqXHR.success) {
                        modalCreate.modal('hide');
                        table.ajax.reload();
                        form.trigger('reset');
                    }

                });
            });
            // ========== Create User ==========

            // ========== Update User ==========
            var modalUpdate = $('#modalUserUpdate');

            $(document).on('click', '.edit', function() {
                modalUpdate.modal('show');
                var data = $(this).data('single_source');
                console.log('data', data);

                // trigger form first
                $('#form_update_user').trigger('reset');

                $('#inputIdUpdate').val(data.id);
                $('#inputNameUpdate').val(data.name);
                $('#inputUsernameUpdate').val(data.username);
                $('#inputEmailUpdate').val(data.email);
                $('#selectRoleUpdate').val(data.roles[0].id).change();
                $('#selectWilayahUpdate').val(data.operator_pivots.kode_kec).change();
            });

            $('.btn-update-user').on('click', function(e) {
                e.preventDefault();
                $('#form_update_user').submit();
            });

            $('#form_update_user').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var method = form.attr('method');
                var data = form.serialize();

                var url = `{{ route('user_ajax.update') }}`;

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        modalUpdate.block();
                    },
                    complete: function(jqxhr, txt_status) {
                        // console.log(JSON.stringify(jqxhr));
                        statusCodeGlobal(jqxhr.status);
                    },
                }).done(function(data, textStatus, jqXHR) {
                    // Process data, as received in data parameter

                    // show success message
                    iziToast.success({
                        timeout: 2000,
                        title: 'Berhasil',
                        message: data.message,
                        position: 'topRight',
                    });
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    // Request failed. Show error message to user.
                    // errorThrown has error message, or 'timeout' in case of timeout.
                    var errors = objectToArray(jqXHR.responseJSON
                        .errors);

                    return errors.forEach(element => {
                        iziToast.error({
                            title: 'Kesalahan',
                            message: element[1][0],
                            position: 'topRight',
                        });
                    });
                }).always(function(jqXHR, textStatus, errorThrown) {
                    // Hide spinner or loader
                    // console.log(jqXHR);
                    modalUpdate.unblock();
                    if (jqXHR.success) {
                        modalUpdate.modal('hide');
                        table.ajax.reload();
                        form.trigger('reset');
                    }

                });
            });
            // ========== Update User ==========

            // ========== Update Password ==========
            var modalUpdatePassword = $('#modalUserUpdatePassword');
            $(document).on('click', '.edit-password', function() {
                modalUpdatePassword.modal('show');
                var data = $(this).data('single_source');
                console.log('data', data);

                $('#inputIdDelete').val(data.id);
                $('#titleNameDelete').text(data.name);
            });

            $('.btn-update-user-password').on('click', function(e) {
                e.preventDefault();
                $('#form_update_password').submit();
            });

            $('#form_update_password').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = `{{ route('user_ajax.update_password') }}`;
                var method = form.attr('method');
                var data = form.serialize();
                modalUpdatePassword.block();

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'json',
                    complete: function(jqxhr, txt_status) {
                        // console.log(JSON.stringify(jqxhr));
                        statusCodeGlobal(jqxhr.status);
                    },
                }).done(function(data, textStatus, jqXHR) {
                    // Process data, as received in data parameter
                    // console.log(data);
                    modalUpdatePassword.unblock();
                    if (jqXHR.status == 200) {
                        modalUpdatePassword.modal('hide');
                        table.ajax.reload();
                        form.trigger('reset');
                    }

                    // show success message
                    iziToast.success({
                        timeout: 2000,
                        title: 'Berhasil',
                        message: data.message,
                        position: 'topRight',
                    });

                }).fail(function(jqXHR, textStatus, errorThrown) {
                    // Request failed. Show error message to user.
                    // errorThrown has error message, or 'timeout' in case of timeout.
                    modalUpdatePassword.unblock();
                    var errors = objectToArray(jqXHR.responseJSON
                        .errors);

                    return errors.forEach(element => {
                        iziToast.error({
                            title: 'Kesalahan',
                            message: element[1][0],
                            position: 'topRight',
                        });
                    });
                }).always(function(jqXHR, textStatus, errorThrown) {
                    // Hide spinner or loader
                    // console.log(jqXHR);
                    if (jqXHR.success) {
                        modalUpdatePassword.modal('hide');
                        table.ajax.reload();
                        form.trigger('reset');
                    }

                });
            });
            // ========== Update Password ==========

            // ========== Delete User ==========
            $(document).on('click', '.delete', function() {
                var data = $(this).data('single_source');

                var url = " user_ajax/destroy/" + data.id;

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
            // ========== Delete User ==========
        });
    </script>
@endpush
