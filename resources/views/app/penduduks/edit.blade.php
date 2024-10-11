@extends('layouts.admin')

@section('title', 'Edit User')

@section('main')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Edit Penduduk form</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.penduduks.update', $penduduk) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('admin.penduduks._form')
                        <div class="form-group">
                            @permission('penduduks.update')
                                <button type="submit" class="btn btn-primary mr-2">{{ __('Update') }}</button>
                            @endpermission
                            <a href="{{ route('admin.penduduks.index') }}" class="btn btn-default"
                                role="button">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
