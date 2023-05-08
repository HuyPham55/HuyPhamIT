@extends('admin.layout')

@section('title', __('backend.files'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('backend.files') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item active">
                    {{ trans('backend.files') }}
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <iframe src="/admin/laravel-filemanager?type=file" style="width: 100%; height: 80vh; min-height: 500px; overflow: hidden; border: none;"></iframe>
            </div>
        </div>
    </div>
@stop
