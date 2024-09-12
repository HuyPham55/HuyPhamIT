<button type="button" onclick="confirmAjaxDelete('{{ $route ?? '#' }}', '{{ $key ?? 0 }}');"
        class="btn waves-effect waves-light btn-danger @if(!empty($can) && !empty($item)) @cannot($can, $item) disabled @endcannot @endif" title="{{ __('label.action.delete') }}">
    <i class="fa fa-trash"></i>
</button>
