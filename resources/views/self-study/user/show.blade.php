@extends('layouts.admin-app')

@section('page-title')
    {{ __('User Details') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __('View') }} - {{ $user->name }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>{{ __('User Information') }}</h5>
                        <div>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                <i class="ti ti-pencil"></i> {{ __('Edit') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card border shadow-none">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">{{ __('Basic Information') }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="200">{{ __('Name') }}</th>
                                                <td>{{ $user->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Email') }}</th>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Role') }}</th>
                                                <td>
                                                    @foreach($user->roles as $role)
                                                        <span class="badge rounded p-2 f-w-600 bg-light-primary">{{ $role->name }}</span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-8">
                            <div class="card border shadow-none">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">{{ __('Managed Standards') }}</h5>
                                </div>
                                <div class="card-body">
                                    @if($user->standards->count() > 0)
                                        <div class="row">
                                            @foreach($user->standards->groupBy('parent_id') as $standards)
                                                <div class="col-md-6 mb-4">
                                                    <div class="card border">
                                                        <div class="card-header bg-light">
                                                            <h6 class="mb-0">
                                                                @if($standards->first()->parent)
                                                                    {{ $standards->first()->parent->name }}
                                                                @else
                                                                    {{ __('Main Standards') }}
                                                                @endif
                                                            </h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <ul class="list-unstyled mb-0">
                                                                @foreach($standards as $standard)
                                                                    <li class="mb-2">
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="ti ti-chevron-right text-primary me-2"></i>
                                                                            <span>{{ $standard->name }}</span>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-3">
                                            <i class="ti ti-clipboard-x text-muted display-4"></i>
                                            <p class="mt-2">{{ __('No standards assigned to this user.') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
