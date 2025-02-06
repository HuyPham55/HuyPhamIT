@extends('adminlte::master')

@section('adminlte_css')
    @yield('css')
@stop

@section('classes_body', 'lockscreen')

@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="lockscreen-wrapper">

        {{-- Lockscreen logo --}}
        <div class="lockscreen-logo">
            <a href="{{ $dashboard_url }}">
                <img src="{{ asset(config('adminlte.logo_img')) }}" height="50">
                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
            </a>
        </div>

        {{-- Lockscreen item --}}
        <div class="lockscreen-item">
            <form method="POST" action="{{ route('two-factor.login.store') }}"
                  class="lockscreen-credentials @if(!config('adminlte.usermenu_image'))ml-0 @endif">
                @csrf

                <div class="input-group">
                    <input id="code" type="text" name="code"
                           class="form-control @error('code') is-invalid @enderror"
                           placeholder="{{ __('2fa.code') }}" required autofocus>

                    <div class="input-group-append">
                        <button type="submit" class="btn">
                            <i class="fas fa-arrow-right text-muted"></i>
                        </button>
                    </div>
                </div>

            </form>
        </div>

        {{-- Code error alert --}}
        @error('code')
        <div class="lockscreen-subitem text-center" role="alert">
            <b class="text-danger">{{ $message }}</b>
        </div>
        @enderror

        {{-- Help block --}}
        <div class="help-block text-center">
            {{ __('2fa.two_factor_challenge_message') }}
        </div>

        {{-- Additional links --}}
        <div class="text-center">
            <a href="{{ $password_reset_url }}">
                {{ __('adminlte::adminlte.i_forgot_my_password') }}
            </a>
        </div>

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
