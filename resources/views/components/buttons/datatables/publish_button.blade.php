<button type="button" data-route="{{$route}}"
        class="btn waves-effect waves-light btn-warning btn--publish @if(!empty($permission) && !empty($item)) @cannot($permission, $item) disabled @endcannot @endif"
        title="{{ __('label.action.publish') }}">
    <i class="fas fa-newspaper mr-2"></i>
    @lang("label.action.publish")
</button>
