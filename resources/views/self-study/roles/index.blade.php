@extends('layouts.admin-app')
@section('page-title')
    {{ __('Roles') }}
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-0 ">{{ __('Roles') }}</h5>
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Roles') }}</li>
@endsection

@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>
                               
                                    {{ __('Roles') }}
                            </h5>
                        </div>
                        @if (Gate::check('Create Role'))
                            <div class="col-auto">
                                <a href="#" class="btn btn-secondary customModal" data-size="lg"
                                    data-url="{{ route('role.create') }}"
                                    data-title=" {{ __('Create Role') }} ">
                                   
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                  
                                        {{ __('Create Role') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th>{{ __('Role') }}</th>
                                        <th>{{ __('Permissions') }}</th>
                                        <th width="200px">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td style="white-space: inherit">
                                                @foreach ($role->permissions()->pluck('name') as $permission)
                                                    <span class="badge rounded p-2 m-1 px-3 bg-primary ">
                                                        <a href="#" class="text-white">{{ __($permission) }}</a>
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td class="Action">
                                                <span class="d-flex">
                                                    @can('Edit Role')
                                                        <div class="action-btn ms-2">
                                                            <a class="btn btn-sm btn-icon  bg-light-secondary me-2 customModal"
                                                                data-url="{{ route('role.edit',$role->id)}}"
                                                                data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip"
                                                                title="" data-title="{{ __('Edit Role') }}"
                                                                data-bs-original-title="{{ __('Edit') }}">
                                                                <i class="ti ti-edit"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('Delete Role')
                                                    @if( $role->name != 'super admin')
                                                        <div class="action-btn ms-2">
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['role.destroy', $role->id],
                                                                'id' => 'delete-form-' . $role->id,
                                                            ]) !!}
                                                            <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary confirm_dialog"
                                                                href="#" data-title="{{ __('Delete Role') }}"
                                                                data-confirm="{{ __('Are You Sure?') }}"
                                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="delete-form-{{ $role->id }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="{{ __('Delete') }}">
                                                                <i class="ti ti-trash f-20"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        @endif
                                                    @endcan
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection
