@extends('admin.layout')
@section('title', __('label.permissions'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('label.permissions') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item active">
                    {{ __('label.permissions') }}
                </li>
            </ol>
        </div>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            @includeIf('components.notification')
            @can('add_permissions')
                <div class="btn-group mb-2">
                    @includeIf('components.buttons.add', ['route' => route('permissions.add')])
                </div>
            @endcan

            @foreach($data as $permissionGroup)
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            {{ $permissionGroup->name }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="datatables">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">{{ __('label.title') }}</th>
                                    <th scope="col">{{ __('label.name') }}</th>
                                    <th scope="col">{{ __('label.action.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissionGroup->permissions as $permission)
                                    <tr id="row-id-{{ $permission->id }}">
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->title }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            @can('edit_permissions')
                                                @includeIf('components.buttons.edit', ['route' => route('permissions.edit', $permission->id)])
                                            @endcan
                                            @can('delete_permissions')
                                                @includeIf('components.buttons.delete', ['route' => route('permissions.delete'), 'id' => $permission->id])
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection()


