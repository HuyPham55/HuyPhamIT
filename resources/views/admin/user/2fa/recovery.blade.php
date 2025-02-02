@extends('admin.layout')

@section('title', __('2fa.title_short').' - '.__('2fa.setup'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                @lang('2fa.title')
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('users.edit_profile') }}">{{ __('label.my_profile') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('2fa.title_short') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @includeIf('components.notification')
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        @lang('2fa.recovery_codes')
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        @lang('2fa.recovery_codes_desc')
                    </p>
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="list-group">
                                @foreach (Auth::user()->recoveryCodes() as $code)
                                    <li class="list-group-item list-group-item-danger">{{ $code }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
