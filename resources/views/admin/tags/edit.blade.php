@extends('admin.layout')
@php
    $targetLabel = __('menu.tags');
    $actionLabel = trans('label.action.edit');
    $title = $targetLabel." - ".$actionLabel;
@endphp
@section('title', $title)
@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ $actionLabel }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item">
                    <a href="{{route('tags.list')}}">
                        {{ __('menu.tags') }}
                    </a>
                </li>
                <li class="breadcrumb-item active">{{ $actionLabel }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @includeIf('components.notification')
            <div class="card">
                <form action="" method="POST" class="form-horizontal pt-3">
                    @csrf
                    @method('PUT')
                    @include('admin.tags.form')
                    <div class="card-footer">
                        <div class="action-form">
                            <div class="form-group mb-0 text-center">
                                @includeIf('components.buttons.submit')
                                @includeIf('components.buttons.cancel')
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card card-secondary border border-secondary my-3">
                <div class="card-header">
                    <h5 class="card-title">
                        {{trans('label.information')}}
                        <i class="ml-2 fa fa-info-circle"></i>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                @if($model->author)
                                    <tr>
                                        <th scope="row">
                                            <i class="fa fa-user text-danger mr-2"></i>
                                            <b>{{trans('label.created_by')}}</b>
                                        </th>
                                        <td>
                                            {{$model->author?->name}}
                                        </td>
                                    </tr>
                                @endif
                                @if($model->created_at)
                                    <tr>
                                        <th scope="row">
                                            <i class="fa fa-clock text-danger mr-2"></i>
                                            <b>{{trans('label.created_at')}}</b>
                                        </th>
                                        <td>
                                            {{formatDate($model->created_at)}}
                                            ({{ \Carbon\Carbon::parse($model->created_at)->longRelativeToNowDiffForHumans(now()) }})
                                        </td>
                                    </tr>
                                @endif
                                @if($model->updater)
                                    <tr>
                                        <th scope="row">
                                            <i class="fa fa-user text-success mr-2"></i>
                                            <b>{{trans('label.updated_by')}}</b>
                                        </th>
                                        <td>
                                            {{$model->updater?->name}}
                                        </td>
                                    </tr>
                                @endif
                                @if($model->updated_at)
                                    <tr>
                                        <th scope="row">
                                            <i class="fa fa-clock text-success mr-2"></i>
                                            <b>{{trans('backend.updated_at')}}</b>
                                        </th>
                                        <td>
                                            {{formatDate($model->updated_at)}}
                                            ({{ \Carbon\Carbon::parse($model->updated_at)->longRelativeToNowDiffForHumans(now()) }})
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

