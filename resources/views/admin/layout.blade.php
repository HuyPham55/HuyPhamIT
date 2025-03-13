@extends('adminlte::page')
@if(cachedOption('site_favicon'))
    @section('meta_tags')
        <link rel="shortcut icon" href="{{ asset(cachedOption('site_favicon')) }}"/>
    @endsection
@endif
@push('js')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script type="text/javascript">
        let labels = {
            cancel: '{{trans('label.action.cancel')}}',
            status: {
                canceled: '{{trans('label.status.canceled')}}',
                success: '{{trans('label.notification.success')}}',
            },
            action: {
                confirm_action: '{{trans('label.action.confirm_action')}}',
            }
        }

        $('.lfm-image').filemanager('image');
        $('.lfm-file').filemanager('file');
    </script>
    <script src="{{asset('/backend/js/backend.js'). '?version=' . filemtime(public_path('js/places.js'))}}"></script>
@endpush
@section('plugins.Sweetalert2', true)
