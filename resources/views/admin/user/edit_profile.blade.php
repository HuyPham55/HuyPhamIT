@extends('admin.layout')

@section('title',__('label.action.update'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('label.action.update') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('label.my_profile') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @includeIf('components.notification')
            <div class="card">
                <form action="" method="POST" class="form-horizontal pt-3">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">{{ __('label.image') }}</label>
                            @includeIf('components.select_file', [
                                'keyId' => "profile_picture",
                                'inputName' => "profile_picture",
                                'inputValue' => old("profile_picture") ?? $data->profile_picture,
                                'lfmType' => 'image',
                                'note' => '',
                            ])
                        </div>

                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-2 control-label col-form-label">{{ __('label.name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" value="{{ old('name') ?? $data->name }}"
                                       class="form-control" required maxlength="191">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description"
                                   class="control-label">{{ __('backend.short_description') }}</label>
                            <textarea id="description" name="description"
                                      class="form-control" rows="5" maxlength="300"
                            >{{ old("site_description") ?? $data->description }}</textarea>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-sm-2 control-label col-form-label">{{ __('label.email') }}</label>
                            <div class="col-sm-10">
                                <input type="email" id="email" name="email"
                                       value="{{ old('email') ?? $data->email }}" class="form-control" required>
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="old_password"
                                   class="col-sm-2 control-label col-form-label">{{ trans('label.old_password') }}</label>
                            <div class="col-sm-10">
                                <input type="password" id="old_password" name="old_password" value=""
                                       class="form-control" minlength="8">
                                @error('old_password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="action-form">
                            <div class="form-group mb-0 text-center">
                                @includeIf('components.buttons.submit')
                                @includeIf('components.buttons.cancel')
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="jumbotron">
                        <h1>
                            @lang('2fa.title')
                        </h1>
                        <p class="lead">
                            @lang('2fa.description')
                        </p>
                        @if(request()->user()->hasEnabledTwoFactorAuthentication())
                            <a class="btn btn-lg btn-danger remove-authenticator" href="{{route('users.two-factor-authentication.remove')}}"
                               role="button">
                                @lang('2fa.remove')
                            </a>
                        @else
                            <a class="btn btn-lg btn-primary" href="{{route('users.two-factor-authentication.enable')}}"
                               role="button">
                                @lang('2fa.setup')
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@push('script')
    <script>
        jQuery(() => {
            jQuery(".remove-authenticator").on('click', function () {

            })
        })
    </script>
@endpush
