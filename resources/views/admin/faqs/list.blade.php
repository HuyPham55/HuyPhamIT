@php
    use App\Enums\CommonStatus;
@endphp
@extends('admin.layout')
@section('title', trans('label.faqs'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('label.faqs') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('label.faqs') }}</li>
            </ol>
        </div>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            @includeIf('components.notification')
            @can('add_faqs')
                <div class="btn-group mb-2">
                    @includeIf('components.buttons.add', ['route' => route('faqs.add')])
                </div>
            @endcan

            @include('admin.faqs.filter_bar')

            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{trans('label.total')}}: {{$posts->total()}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('label.title') }}</th>
                                <th scope="col">{{ __('backend.sorting') }}</th>
                                <th scope="col">{{ __('label.status.status') }}</th>
                                <th scope="col">{{ __('label.created_at') }}</th>
                                <th scope="col">{{ __('label.action.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $item)
                                <tr id="row-id-{{ $item->id }}">
                                    <td>
                                        {{$item->title}}
                                    </td>
                                    <td>
                                        @if(auth()->user()->can('edit_faqs'))
                                            <input type="number" value="{{ $item->sorting }}"
                                                   data-item="{{ $item->id }}" title=""
                                                   class="update-sorting" style="max-width: 75px;" min="0" max="e9"
                                                   placeholder="0">
                                        @else
                                            {{ $item->sorting }}
                                        @endif
                                    </td>
                                    <td class="bt-switch">
                                        <input type="checkbox" class="change-status" data-field="status"
                                               data-item-id="{{ $item->id }}" title=""
                                               data-size="normal" data-on-color="success"
                                               data-on-text="{{ __('label.on') }}" data-off-text="{{ __('label.off') }}"
                                               {{ $item->status == 1 ? 'checked' : '' }}
                                               @cannot('edit_faqs')
                                                   disabled
                                            @endcannot
                                        />
                                    </td>
                                    <td>{{ $item->date_format }}</td>
                                    <td>
                                        @can('edit_faqs')
                                            @includeIf('components.buttons.edit', ['route' => route('faqs.edit', $item->id)])
                                        @endcan

                                        @can('delete_faqs')
                                            @includeIf('components.buttons.delete', ['route' => route('faqs.delete'), 'id' => $item->id])
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" style="text-align: center"><i>No record</i></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <hr>
                        <div class="d-flex justify-content-center">
                            {{ $posts->appends(request()->all())->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
@include('components.toastr')
@include('components.bootstrapSwitch')

@push('js')
    <script type="text/javascript">
        jQuery(() => {
            jQuery(".bt-switch input[type='checkbox']").bootstrapSwitch();

            jQuery('.change-status').on('switchChange.bootstrapSwitch', function (event) {
                let field = jQuery(this).data('field');
                let itemId = jQuery(this).data('item-id');
                let isChecked = event.target.checked;

                if (itemId) {
                    postData("{{ route('faqs.change_status') }}", {
                        'field': field,
                        'item_id': itemId,
                        'status': isChecked ? 1 : 0,
                    });
                }
            });

            jQuery('.update-sorting').on('input', function () {
                let itemId = jQuery(this).data('item');
                let sorting = jQuery(this).val();

                if (itemId) {
                    postData("{{ route('faqs.change_sorting') }}", {
                        'item_id': itemId,
                        'sorting': sorting,
                    });
                }
            });
        })
    </script>
@endpush
