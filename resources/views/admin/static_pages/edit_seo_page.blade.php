@extends('admin.layout')
@php
    $targetLabel = request('title') ? trans(request('title')) : trans(request('key'));
    $actionLabel = trans('label.action.edit');
    $title = $targetLabel." - ".$actionLabel;
@endphp
@section('title', $title)
@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ $actionLabel }} - {{request('title')}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item active">{{ $actionLabel }}</li>
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
                        <div class="row">
                            <div class="col-sm-12">
                                @if(count($lang) > 1)
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link disabled" aria-disabled="true">
                                                {{ __('label.language') }}
                                            </a>
                                        </li>
                                        @foreach($lang as $langKey => $langTitle)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                                                   href="#tab_lang_{{ $langKey }}">
                                                    {{ $langTitle }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <br>
                                @endif
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    @foreach($lang as $langKey => $langTitle)
                                        <div id="tab_lang_{{ $langKey }}" class="tab-pane container p-0 {{ $loop->first ? 'active' : '' }}">

                                            <div class="form-group">
                                                <label
                                                    class="control-label">{{ __('backend.seo.image') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                                                @includeIf('components.select_file', [
                                                    'keyId' => "image-{$langKey}",
                                                    'inputName' => "{$langKey}[image]",
                                                    'inputValue' => old("$langKey.image") ?? $page->getTranslation('image', $langKey, false),
                                                    'lfmType' => 'image',
                                                    'note' => '',
                                                ])
                                            </div>

                                            <div class="form-group">
                                                <label for="{{ $langKey }}[title]"
                                                       class="control-label">{{ __('label.title') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                                                <input type="text" name="{{ $langKey }}[title]" id="{{ $langKey }}[title]"
                                                       value="{{ old("$langKey.title") ?? $page->getTranslation('title', $langKey, false) }}"
                                                       autocomplete="off" title=""
                                                       class="form-control" maxlength="155">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('components.form_elements.seo', ['data' => $page])


                    <div class="card-footer">
                        <div class="action-form">
                            <div class="form-group mb-0 text-center">
                                @includeIf('components.buttons.submit')
                                @includeIf('components.buttons.cancel')
                            </div>
                        </div>
                    </div>
                    @include('components.form_elements.alertUnsavedChange')
                </form>
            </div>
        </div>
    </div>
@endsection

