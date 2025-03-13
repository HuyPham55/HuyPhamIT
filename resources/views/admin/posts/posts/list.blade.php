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
                    <table class="table table-hover" id="datatables">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('label.title') }}</th>
                            <th scope="col">{{ __('backend.sorting') }}</th>
                            <th scope="col">{{ __('label.status.status') }}</th>
                            <th scope="col">{{ __('label.created_at') }}</th>
                            <th scope="col">{{ __('backend.updated_at') }}</th>
                            <th scope="col">{{ __('label.publish_date') }}</th>
                            <th scope="col">{{ __('label.action.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.posts.posts.components.template')
    </div>
@endsection()
@include('components.toastr')
@include('components.bootstrapSwitch')
@include('components.Datatables')
@include('components.Select2')

@push('js')
    <input type="hidden" name="posts.datatables" value="{{route('posts.datatables')}}">
    <input type="hidden" name="posts.change_status" value="{{route('posts.change_status')}}">
    <input type="hidden" name="posts.change_sorting" value="{{route('posts.change_sorting')}}">
    <script src="{{asset('/backend/js/post_list.js').'?version=' . filemtime(public_path('/backend/js/post_list.js'))}}"></script>
@endpush
