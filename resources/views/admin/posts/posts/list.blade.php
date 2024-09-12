@extends('admin.layout')
@section('title', __('label.posts'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('label.posts') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item active">
                    {{ __('label.posts') }}
                </li>
            </ol>
        </div>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            @includeIf('components.notification')
            <div class="btn-group mb-2">
                @can('add_posts')
                    @includeIf('components.buttons.add', ['route' => route('posts.add')])
                @endcan
                <button class="btn btn-outline-success ml-2 refresh">
                    <i class="fa fa-sync mr-2"></i>
                    {{trans('label.action.refresh')}}
                </button>
            </div>

            @include('admin.posts.posts.filter_bar')

            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{trans('label.total')}}: {{$total_count}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatables">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{ __('label.image') }}</th>
                                <th scope="col">{{ __('label.title') }}</th>
                                <th scope="col">{{ __('backend.sorting') }}</th>
                                <th scope="col">{{ __('label.status.status') }}</th>
                                <th scope="col">{{ __('label.created_at') }}</th>
                                <th scope="col">{{ __('backend.updated_at') }}</th>
                                <th scope="col">{{ __('label.action.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
@include('components.toastr')
@include('components.bootstrapSwitch')
@include('components.Datatables')
@include('components.Select2')

@push('js')
    <script type="text/javascript">
        jQuery(() => {
            let imageContainer = (data) => `<img src="${data}" style="max-width: 125px;"/>`;
            let sortingContainer = (data) => `<input class="update-sorting form-control" style="max-width: 125px;" type="number" value="${data}" max="e9"/>`;
            let datatablesCallback = () => {
                jQuery(".bt-switch input[type='checkbox']").bootstrapSwitch();
            }
            let filter = jQuery("#filter")
            let refreshBtn = jQuery("button.refresh")

            const initialize = function () {
                let filterData = {};
                if (filter) {
                    filterData = {
                        categories: jQuery("select[name='categories']").val(),
                        status: jQuery("select[name='status']").val(),
                    };
                }
                return jQuery("#datatables").DataTable({
                    serverSide: true,
                    processing: true,
                    responsive: true,
                    destroy: true,
                    ajax: {
                        "url": '{{route('posts.datatables')}}',
                        data: filterData
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'image', name: 'image', orderable: false, render: imageContainer},
                        {data: 'title', name: 'title'},
                        {data: 'sorting', name: 'sorting', render: sortingContainer},
                        {data: 'status', name: 'status'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'action', name: 'action', orderable: false}
                    ],
                    order: [[0, 'desc']],
                    drawCallback: datatablesCallback
                });
            }
            let table = initialize();

            jQuery(filter).on("change", function() {
                initialize()

            })
            jQuery(filter).on("submit", function(e) {
                e.preventDefault();
                initialize()
            })

            jQuery(refreshBtn).on("click", function () {
                initialize()
                jQuery(this).attr("disabled", "")
                setTimeout(() => {
                    jQuery(this).removeAttr('disabled')
                }, 500)
            })


            jQuery(document).on('switchChange.bootstrapSwitch', '.change-status', function (event) {
                let field = jQuery(this).data('field');
                let tr = jQuery(this).closest("tr");
                let trId = tr.attr('id')
                let itemId = trId.split('row-id-')[1];
                let isChecked = event.target.checked;

                if (itemId) {
                    patchData("{{route('posts.change_status')}}" + `/${itemId}`, {
                        'field': field,
                        'status': isChecked ? 1 : 0,
                        '_token': '{{ csrf_token() }}'
                    });
                }
            });

            //change sorting
            jQuery(document).on('input', '.update-sorting', function (e) {
                e.stopPropagation();
                let tr = jQuery(this).closest("tr");
                let trId = tr.attr('id')
                let itemId = trId.split('row-id-')[1];
                let sorting = jQuery(this).val();

                if (itemId) {
                    patchData("{{ route('posts.change_sorting') }}" + `/${itemId}`, {
                        'item_id': itemId,
                        'sorting': sorting,
                        '_token': '{{ csrf_token() }}'
                    });
                }
            });
        })
    </script>
@endpush
