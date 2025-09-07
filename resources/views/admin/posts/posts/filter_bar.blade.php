<div class="card card-primary">
    <div class="card-body">
        <form id="filter">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="categories">{{__('label.category')}}</label>
                    <select type="text" name="categories" id="categories" class="form-control select2">
                        <option value="">{{__('label.all')}}</option>
                        @foreach($categories as $key=>$category)
                            <option {{request()->input('category') == $key ? 'selected' : ''}} value="{{$key}}">
                                {{$category}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="status">{{__('label.status.status')}}</label>
                    <select type="text" name="status" id="status" class="form-control">
                        <option value="" selected>{{__('label.all')}}</option>
                        <option
                            value="1" {{request()->input('status')?"selected":""}}>{{__('label.on')}}</option>
                        <option
                            value="0" {{ !is_null(request()->input('status')) && !request()->input('status')?"selected":""}}>{{__('label.off')}}</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="tags">{{__('menu.tags')}}</label>
                    <select type="text" name="tags[]" id="tags" class="form-control select2" multiple="multiple">
                        <option value="" disabled>
                            @lang('label.none')
                        </option>
                        @forelse($tags as $tag)
                            <option value="{{ $tag->id }}">
                                {{ $tag->name }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <button class="btn btn-danger" type="reset">
                <i class="fa fa-fw fa-eraser"></i>
                {{__('label.action.reset')}}
            </button>
            <button class="btn btn-outline-primary" type="submit">
                <i class="fa fa-fw fa-search"></i>
                {{__('label.search')}}
            </button>
        </form>
    </div>
</div>
