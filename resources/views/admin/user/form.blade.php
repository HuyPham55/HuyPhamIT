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
        <label for="username"
               class="col-sm-2 control-label col-form-label">{{ __('label.username') }}</label>
        <div class="col-sm-10">
            <input type="text" id="username" name="username" value="{{ old('username') ?? $data->username}}"
                   autocomplete="off" class="form-control" required>
            @error('username')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="name"
               class="col-sm-2 control-label col-form-label">{{ __('label.name') }}</label>
        <div class="col-sm-10">
            <input type="text" id="name" name="name" value="{{ old('name') ?? $data->name}}"
                   autocomplete="off" class="form-control" required>
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="description"
               class="col-sm-2 control-label col-form-label">{{ __('backend.short_description') }}</label>
        <div class="col-sm-10">
           <textarea id="description" name="description"
                     class="form-control" rows="5" maxlength="300"
           >{{ old("site_description") ?? $data->description }}</textarea>
            @error('description')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email"
               class="col-sm-2 control-label col-form-label">{{ __('label.email') }}</label>
        <div class="col-sm-10">
            <input type="email" id="email" name="email" value="{{ old('email') ?? $data->email }}"
                   autocomplete="off" class="form-control" required>
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password"
               class="col-sm-2 control-label col-form-label">{{ __('label.password') }}</label>
        <div class="col-sm-10">
            <input type="password" id="password" name="password" value="{{ old('password') }}"
                   autocomplete="off" class="form-control" minlength="8">
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password_confirmation"
               class="col-sm-2 control-label col-form-label">{{ __('label.password_confirmation') }}</label>
        <div class="col-sm-10">
            <input type="password" id="password_confirmation" name="password_confirmation"
                   value="{{ old('password_confirmation') }}" class="form-control" minlength="8">
            @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    @php
        $rolesOfUser = $data->getRoleNames()->toArray();
    @endphp
    <div class="form-group row">
        <label for="role" class="col-sm-2  control-label col-form-label">
            {{ __('label.roles') }}
        </label>
        <div class="col-sm-5">
            <div class="input-group">
                <select id="role" name="role[]" class="form-control select2" required multiple>
                    @foreach($roles as $role)
                        <option
                            value="{{ $role->id }}" {{ in_array($role->name, $rolesOfUser) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        @php
            $options = [
                'value' => $data->status ?? true,
                'label' => __('label.status.status'),
                'name' => 'status',
            ];
        @endphp
        @include('components.form_elements.mono_radio', $options)
    </div>
</div>
<hr>
<div class="card-footer">
    <div class="action-form">
        <div class="form-group mb-0 text-center">
            @includeIf('components.buttons.submit')
            @includeIf('components.buttons.cancel')
        </div>
    </div>
</div>

@include('components.Select2')
