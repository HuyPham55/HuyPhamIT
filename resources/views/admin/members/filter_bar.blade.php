<div class="card">
    <div class="card-body">
        <form id="form-filter">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="keyword">{{__('label.search')}}</label>
                    <input title="" class="form-control mr-sm-2" value="{{request('keyword')}}" id="keyword" autocomplete="off" name="keyword">
                </div>
                <div class="form-group col-md-4">
                    <label for="status">{{__('label.status.status')}}</label>
                    <select type="text" name="status" id="status" class="form-control">
                        <option value="" selected>{{__('label.all')}}</option>
                        <option value="1" {{request()->input('status')?"selected":""}}>
                            {{__('label.on')}}
                        </option>
                        <option value="0" {{ !is_null(request()->input('status')) && !request()->input('status')?"selected":""}}>
                            {{__('label.off')}}
                        </option>
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

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            jQuery("button[type='reset']").on("click", function () {
                jQuery('#status').val("").trigger("change");
                jQuery('#keyword').val("").trigger("change");

            })
            jQuery("form#form-filter select").on('change', function () {
                jQuery("form#form-filter").submit();
            })
        });
    </script>
@endpush
