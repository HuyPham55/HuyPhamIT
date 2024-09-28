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
                            <label for="{{ $langKey }}[name]"
                                   class="control-label">{{ __('label.title') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                            <input type="text" name="{{ $langKey }}[name]" id="{{ $langKey }}[name]"
                                   value="{{ old("$langKey.name") ?? $model->getTranslation('name', $langKey, false) }}"
                                   autocomplete="off" title=""
                                   class="form-control" maxlength="155">
                        </div>


                        <div class="form-group">
                            <label for="{{ $langKey }}slug"
                                   class="control-label">{{ __('backend.slug') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                            <div class="input-group mb-3">
                                <input type="text" name="{{ $langKey }}[slug]" id="{{ $langKey }}slug"
                                       value="{{ old("$langKey.slug") ?? $model->getTranslation('slug', $langKey, false) }}"
                                       placeholder="{{trans('label.not_required')}}"
                                       autocomplete="off"
                                       class="form-control" maxlength="155">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="resetInput('{{ $langKey }}slug')">
                                        <i class="fa fa-eraser mr-2"></i>
                                        {{trans('label.action.clear')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



@include('components.form_elements.alertUnsavedChange')
