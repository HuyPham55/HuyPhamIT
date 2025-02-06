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
                        @lang('2fa.download_an_authentication_app')
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        @lang('2fa.download_an_authentication_app_desc')
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        @lang('2fa.scan_the_code')
                    </div>
                </div>
                @if (Auth::user()->two_factor_secret)
                    <div class="card-body">
                        {!! request()->user()->twoFactorQrCodeSvg() !!}
                        <p>
                            @lang('2fa.scan_the_code_desc')
                        </p>
                        {{ decrypt(request()->user()->two_factor_secret) }}
                    </div>
                @else
                @endif
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        @lang('2fa.enter_authentication_code')
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('users.two-factor-authentication.confirmed')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="authentication_code">
                                        @lang('2fa.authentication_code')
                                    </label>
                                    <input autocomplete="off" name="code" type="text" class="form-control @error('code', 'confirmTwoFactorAuthentication') is-invalid @enderror" id="authentication_code" value="{{old('code')}}"/>
                                    @error('code', 'confirmTwoFactorAuthentication')
                                    <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('label.action.submit')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
