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
                                class="control-label">{{ __('label.image') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                            @includeIf('components.select_file', [
                                'keyId' => "image-{$langKey}",
                                'inputName' => "{$langKey}[image]",
                                'inputValue' => old("$langKey.image") ?? $category->getTranslation('image', $langKey, false),
                                'lfmType' => 'image',
                                'note' => '',
                            ])
                        </div>

                        <div class="form-group">
                            <label for="{{ $langKey }}[title]"
                                   class="control-label">{{ __('label.title') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                            <input type="text" name="{{ $langKey }}[title]" id="{{ $langKey }}[title]"
                                   value="{{ old("$langKey.title") ?? $category->getTranslation('title', $langKey, false) }}"
                                   autocomplete="off"
                                   class="form-control" maxlength="155">
                        </div>

                        <div class="form-group">
                            <label for="{{ $langKey }}slug"
                                   class="control-label">{{ __('backend.slug') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                            <div class="input-group mb-3">
                                <input type="text" name="{{ $langKey }}[slug]" id="{{ $langKey }}slug"
                                       value="{{ old("$langKey.slug") ?? $category->getTranslation('slug', $langKey, false) }}"
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

@include('components.form_elements.seo', ['data' => $category])

<div class="card-body">
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="parent_category" class="control-label">{{ __('label.parent_category') }}</label>
                <select id="parent_category" class="form-control select2" name="parent_category" required>
                    @foreach($categories as $cat_id => $cat_name)
                        <option value="{{ $cat_id }}" {{ old('parent_category') == $cat_id || $category->parent_id == $cat_id ? 'selected' : '' }}>
                            {!! $cat_name !!}
                        </option>
                    @endforeach
                </select>
                @error('parent_category')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="sorting">{{ __('backend.sorting') }}</label>
                <input type="number" name="sorting" id="sorting" value="{{ old("sorting") ?? $category->sorting }}"
                       class="form-control" min="0" max="e9" placeholder="0">
            </div>
        </div>

        @php
        $options = [
            'value' => $category->status ?? true,
            'label' => __('label.status.status'),
            'name' => 'status',
            ];
        @endphp
        @include('components.form_elements.mono_radio', $options)

    </div>
</div>

<div class="card-footer">
    <div class="action-form">
        <div class="form-group mb-0 text-center">
            @includeIf('components.buttons.submit')
            @includeIf('components.buttons.cancel')
        </div>
    </div>
</div>

@include('components.Select2')
