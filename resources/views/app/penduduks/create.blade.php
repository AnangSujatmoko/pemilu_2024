@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DPT</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">DPT</a></li>
                            <li class="breadcrumb-item active">Tambah DPT</li>
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
                            <h3 class="card-title">Tambah Data DPT</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('penduduks.store') }}" method="POST">
                                @csrf

                                @include('app.penduduks._form')

                                <div class="form-group text-center">

                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save"></i>
                                        {{ __('Save') }}</button>

                                    <a href="{{ route('penduduks.index') }}" class="btn btn-danger" role="button"><i
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
