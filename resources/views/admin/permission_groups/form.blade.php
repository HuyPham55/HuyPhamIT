<div class="card-body">
    <div class="row">
        <div class="col-sm-12">

            <div class="form-group">
                <label for="title"
                       class="control-label">{{ __('label.title') }}</label>
                <input type="text" name="name" id="name"
                       value="{{ old("name") ?? $data->name }}"
                       autocomplete="off" title=""
                       class="form-control" maxlength="155">
                @error('name')
                <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>
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
