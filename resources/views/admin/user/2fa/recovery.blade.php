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
                            <ul class="list-group mb-4">
                                @foreach (Auth::user()->recoveryCodes() as $code)
                                    <li class="list-group-item list-group-item-danger">{{ $code }}</li>
                                @endforeach
                            </ul>
                            <div class="form-group">
                                <label>
                                    <input class="form-check-inline" name="confirm" type="checkbox"/>
                                    <span>
                                        {{trans('2fa.recovery_codes_confirm')}}
                                    </span>
                                </label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger btn--complete" data-href="{{route('users.edit_profile')}}" disabled>
                                    @lang('label.my_profile')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        jQuery(() => {
            jQuery("input[name=confirm]").on('change', function() {
                let value = !!jQuery(this).prop('checked');
                if (value) {
                    jQuery(".btn--complete").removeAttr('disabled');
                } else {
                    jQuery(".btn--complete").attr('disabled', '');
                }
            })

            jQuery(".btn--complete").on('click', function() {
                let href = jQuery(this).data('href');
                if (href) {
                    location.href = href;
                }
            })
        })
    </script>
@endpush
