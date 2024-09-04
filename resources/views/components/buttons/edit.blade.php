<a href="{{ $route ?? '#' }}" class="btn waves-effect waves-light btn-primary @if(!empty($can) && !empty($item)) @cannot($can, $item) disabled @endcannot @endif" title="{{ __('label.action.edit') }}">
    <i class="fas fa-edit"></i>
</a>
