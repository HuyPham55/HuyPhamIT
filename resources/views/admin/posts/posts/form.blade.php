<?php
/** @var \App\Models\Post $post */
?>
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
                                'inputValue' => old("$langKey.image") ?? $post->getTranslation('image', $langKey, false),
                                'lfmType' => 'image',
                                'note' => '',
                            ])
                        </div>

                        <div class="form-group">
                            <label for="{{ $langKey }}[title]"
                                   class="control-label">{{ __('label.title') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                            <input type="text" name="{{ $langKey }}[title]" id="{{ $langKey }}[title]"
                                   value="{{ old("$langKey.title") ?? $post->getTranslation('title', $langKey, false) }}"
                                   autocomplete="off" title=""
                                   class="form-control" maxlength="155">
                        </div>

                        <div class="form-group">
                            <label for="{{ $langKey }}slug"
                                   class="control-label">{{ __('backend.slug') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                            <div class="input-group mb-3">
                                <input type="text" name="{{ $langKey }}[slug]" id="{{ $langKey }}slug"
                                       value="{{ old("$langKey.slug") ?? $post->getTranslation('slug', $langKey, false) }}"
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

                        <div class="form-group">
                            <label for="{{ $langKey }}[short_description]"
                                   class="control-label">{{ __('backend.short_description') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                            <textarea id="{{ $langKey }}[short_description]" name="{{ $langKey }}[short_description]"
                                      class="form-control" rows="5"
                            >{{ old("$langKey.short_description") ?? $post->getTranslation('short_description', $langKey, false) }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

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
                               href="#tab_lang_content_{{ $langKey }}">
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
                    <div id="tab_lang_content_{{ $langKey }}" class="tab-pane container p-0 {{ $loop->first ? 'active' : '' }}">
                        @php
                            $postTemplate = request()->url() === route('posts.add') ? option("post_add_template_".$langKey) : null;
                        @endphp
                        <div class="form-group">
                            <label for="{{ $langKey }}[content]"
                                   class="control-label">{{ __('backend.content') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                            <textarea id="{{ $langKey }}[content]" name="{{ $langKey }}[content]"
                                      class="form-control editor" rows="25"
                            >{{ old("$langKey.content") ?? $postTemplate ?? $post->getTranslation('content', $langKey, false) }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('components.form_elements.seo', ['data' => $post])

<div class="card-body">
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="category" class="control-label">
                    {{ __('label.category') }}
                </label>
                <select id="category" name="category" class="form-control select2" required>
                    @forelse($categories as $category_id => $category_title)
                        <option
                            value="{{ $category_id }}" {{ old('category') || request('category') == $category_id || $post->category_id == $category_id ? 'selected' : '' }}>
                            {{ $category_title }}
                        </option>
                    @empty
                        <option value="">{{ __('label.none')}}</option>
                    @endforelse
                </select>
                @error('category')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="category" class="control-label">
                    {{ __('menu.tags') }}
                </label>
                @php
                $arrTags = $post->tags->pluck('id')->toArray();
                @endphp
                <select id="tags" name="tags[]" class="form-control select2" multiple>
                    @forelse($tags as $tag)
                        <option value="{{ $tag->id }}" @if(in_array($tag->id, $arrTags)) selected @endif>
                            {{ $tag->name }}
                        </option>
                    @empty
                        <option value="">{{ __('label.none')}}</option>
                    @endforelse
                </select>
                @error('tags')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        @can('publish_posts')
            <div class="col-md-4">
                <div class="form-group">
                    <label for="publish_date" class="control-label">{{ __('label.publish_date') }}</label>
                    <div>
                        <input type="text" name="publish_date" id="publish_date"
                               placeholder="YYYY-MM-DD"
                               class="form-control datepicker"
                               value="{{$post->publish_date ? date('Y-m-d', strtotime($post->publish_date)): null}}"/>
                        @error('publish_date')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endcan

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="sorting">{{ __('backend.sorting') }}</label>
                <input type="number" name="sorting" id="sorting" value="{{ old("sorting") ?? $post->sorting }}"
                       class="form-control" min="0" max="e9" placeholder="0">
            </div>
        </div>
    </div>
</div>

<div class="card-body">
    <div class="row">
        @php
            $options = [
                'value' => $post->status ?? true,
                'label' => __('label.status.status'),
                'name' => 'status',
            ];
        @endphp
        @include('components.form_elements.mono_radio', $options)
    </div>
</div>

@include('components.ckeditor')
@include('components.Select2')
@include('components.BootstrapDatePicker')
@include('components.form_elements.alertUnsavedChange')
@push('js')
    <script type="text/javascript">
        jQuery(() => {
            jQuery(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
            });
        })
    </script>
@endpush

