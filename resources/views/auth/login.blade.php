{{--@extends('adminlte::auth.login')--}}
@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])
@php
    use Illuminate\Support\Facades\View;
@endphp
@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
@endif

@section('title', config('app.name').' - '.'Login')

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
    <form action="{{ $login_url }}" method="post" id="loginForm">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror"
                   autocomplete="off"
                   placeholder="{{ __('backend.captcha') }}" title="">

            @error('captcha')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="text-center mb-3" id="captcha">
            {!! captcha_img('flat') !!}
        </div>


        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                    <input class="form-check-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="form-check-label">
                        {{ __('adminlte::adminlte.remember_me') }}
                    </label>
                </div>
            </div>
            <div class="col-5 text-center">
                <a href="/">
                    {{trans('menu.frontpage')}}
                </a>
            </div>
        </div>

    </form>
@stop

@section('auth_footer')
    <button type='submit' form="loginForm" id="submitButton"
            class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
        <span class="fas fa-sign-in-alt"></span>
        {{ __('adminlte::adminlte.sign_in') }}
    </button>
    {{-- Password reset link --}}
    @if($password_reset_url)
        <p class="my-0 text-center">
            <a href="{{ $password_reset_url }}">
                {{ __('adminlte::adminlte.i_forgot_my_password') }}
            </a>
        </p>
    @endif
@stop

@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let captcha = document.querySelector("#captcha");
            let refreshRoute = "{{route('contact.refresh_captcha')}}";
            captcha.addEventListener("click", function () {
                captcha.classList.add('loading');
                if (!refreshRoute) return;
                jQuery
                    .post(refreshRoute, {
                        '_token': '{{csrf_token()}}'
                    })
                    .then(res => {
                        captcha.innerHTML = res;
                    })
                    .always(() => {
                        captcha.classList.remove('loading');
                    })
            })
        });
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function (e) {
            let submitButton = document.querySelector("#submitButton");
            if (!submitButton) return
            submitButton.addEventListener('click', function () {
            })
        });
    </script>
@endpush
@push('css')
    <style type="text/css">
        #captcha {
            cursor: pointer;
        }
        #captcha.loading {
            pointer-events: none;
        }
    </style>
@endpush
