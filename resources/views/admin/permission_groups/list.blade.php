@php
    use App\Enums\CommonStatus;
@endphp
@extends('admin.layout')
@section('title', trans('label.permission_groups'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('label.permission_groups') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('label.permission_groups') }}</li>
            </ol>
        </div>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            @includeIf('components.notification')
            @can('add_permission_groups')
                <div class="btn-group mb-2">
                    @includeIf('components.buttons.add', ['route' => route('permission_groups.add')])
                </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('label.title') }}</th>
                                <th scope="col">{{ __('label.action.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $item)
                                <tr id="row-id-{{ $item->id }}">
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>
                                        @can('edit_permission_groups')
                                            @includeIf('components.buttons.edit', ['route' => route('permission_groups.edit', $item->id)])
                                        @endcan

                                        @can('delete_permission_groups')
                                            @includeIf('components.buttons.delete', ['route' => route('permission_groups.delete'), 'id' => $item->id])
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
