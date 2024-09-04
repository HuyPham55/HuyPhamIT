@php
    use App\Enums\CommonStatus;
@endphp
@extends('admin.layout')
@section('title', trans('backend.user'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('backend.user') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('backend.user') }}</li>
            </ol>
        </div>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            @includeIf('components.notification')
            @can('add_users')
                <div class="btn-group mb-2">
                    @includeIf('components.buttons.add', ['route' => route('users.add')])
                </div>
            @endcan
            @include('admin.user.filter_bar')
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{trans('label.total')}}: {{$data->total()}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ __('label.name') }}</th>
                                <th>{{__('label.roles')}}</th>
                                <th>{{ __('label.status.status') }}</th>
                                <th>{{ __('label.created_at') }}</th>
                                <th>{{ __('backend.updated_at') }}</th>
                                <th>{{ __('backend.last_login') }}</th>
                                <th>{{ __('label.action.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $user)
                                <tr id="row-id-{{ $user->id }}">
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @foreach($user->getRoleNames() as $role)
                                            {{ $role }} {{ ! $loop->last ? ', ' : '' }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $user->status == CommonStatus::Active ? 'success' : 'danger' }}">
                                            {{ data_get($status, $user->status, '-') }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td>{{ $user->last_login }}</td>
                                    <td>
                                        @if($user->id <> Auth::id())
                                            @can('edit_users')
                                                @includeIf('components.buttons.edit', ['route' => route('users.edit', $user->id)])
                                            @endcan

                                            @can('delete_users')
                                                @includeIf('components.buttons.delete', ['route' => route('users.delete'), 'id' => $user->id])
                                            @endcan
                                        @endif
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
                            {{ $data->appends(request()->all())->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
