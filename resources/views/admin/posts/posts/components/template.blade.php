<div class="col-12">
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
                                <div id="tab_lang_{{ $langKey }}"
                                     class="tab-pane container p-0 {{ $loop->first ? 'active' : '' }}">
                                    <div class="form-group">
                                        <label for="{{ $langKey }}[content]"
                                               class="control-label">{{ __('backend.template') }} {{ count($lang) > 1 ? "($langTitle)" : '' }}</label>
                                        <textarea id="{{ $langKey }}[content]" name="post_add_template_{{ $langKey }}"
                                                  class="form-control editor" rows="25"
                                        >{{ old("$langKey.content") ?? option("post_add_template_".$langKey) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="action-form">
                    <div class="form-group mb-0 text-center">
                        @includeIf('components.buttons.submit')
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include("components.ckeditor")
@include("components.form_elements.alertUnsavedChange")
