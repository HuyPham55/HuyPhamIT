<div class="card-body">
    <div class="row">
        <div class="col-sm-12">

            <div class="form-group">
                <label for="title"
                       class="control-label">{{ __('label.title') }}</label>
                <input type="text" name="title" id="title"
                       value="{{ old("title") ?? $data->title }}"
                       autocomplete="off" title=""
                       class="form-control" maxlength="155">
                @error('title')
                <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="title"
                       class="control-label">{{ __('label.name') }}</label>
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

<div class="card-body">
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="group" class="control-label">
                    {{ __('label.permission_groups') }}
                </label>
                <select id="group" name="group" class="form-control select2" required>
                    @forelse($permissionGroups as $group)
                        <option value="{{ $group->id }}"
                            {{ old('group') == $group->id || $data->permission_group_id == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @empty
                        <option value="">{{ __('label.none')}}</option>
                    @endforelse
                </select>
                @error('group')
                <p class="text-danger">{{ $message }}</p>
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

@include('components.Select2')
