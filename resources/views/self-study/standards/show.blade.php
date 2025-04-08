@extends('layouts.admin-app')

@section('page-title')
    {{ __('Standard Details') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('standards.index') }}">{{ __('Standards') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __('Standard Details') }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">{{ $standard->name }}</h5>
                        <small class="text-muted">{{ __('Standard Details and Information') }}</small>
                    </div>
                    <div class="d-flex gap-2">
                        @can('Edit Standards')
                            <a href="{{ route('standards.edit', $standard->id) }}" class="btn btn-primary">
                                <i class="ti ti-edit me-1"></i>{{ __('Edit') }}
                            </a>
                        @endcan
                        <a href="{{ route('standards.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i>{{ __('Back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Standard Information -->
                        <div class="col-md-8">
                            <div class="card shadow-none border">
                                <div class="card-header bg-transparent row">
                                    <h5 class="mb-0 col">
                                        <i class="ti ti-info-circle me-2"></i>{{ __('Basic Information') }}
                                    </h5>
                                    <div class="col-auto">
                                        @switch($standard->completion_status)
                                            @case('incomplete')
                                                <span class="badge rounded p-2 f-w-600 bg-light-danger">{{ __('Incomplete') }}</span>
                                            @break

                                            @case('partially_completed')
                                                <span
                                                    class="badge rounded p-2 f-w-600 bg-light-warning">{{ __('Partially Complete') }}</span>
                                            @break

                                            @case('completed')
                                                <span class="badge rounded p-2 f-w-600 bg-light-success">{{ __('Complete') }}</span>
                                            @break
                                        @endswitch
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-muted">{{ __('Standard Name') }}</label>
                                            <p class="mb-0 fw-bold">{{ $standard->name }}</p>
                                        </div>
                                       
                                        <div class="col-12 mb-3">
                                            <label class="form-label text-muted">{{ __('Introduction') }}</label>
                                            <p class="mb-0">
                                                {!! $standard->introduction ?? 'No Introduction available' !!}
                                            </p>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label text-muted">{{ __('Description') }}</label>
                                            <p class="mb-0">
                                                {!! $standard->description ?? 'No description available' !!}
                                            </p>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label text-muted">{{ __('Summary') }}</label>
                                            <p class="mb-0">
                                                {!! $standard->summary ?? 'No summary available' !!}
                                            </p>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                            <!-- Criteria List -->
                            <div class="card shadow-none border mt-4">
                                <div class="card-header bg-transparent">
                                    <h5 class="mb-0">
                                        <i class="ti ti-list-check me-2"></i>{{ __('Criteria') }}
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Compliance') }}</th>
                                                    <th>{{ __('Fulfillment Status') }}</th>
                                                    <th>{{ __('Actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($standard->criteria as $criterion)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <h6 class="mb-0">{{ $criterion->name }}</h6>
                                                                    <small
                                                                        class="text-muted">{{ Str::limit($criterion->description, 50) }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @switch($criterion->is_met)
                                                                @case(1)
                                                                    <span class="badge rounded p-2 f-w-600 bg-light-success">
                                                                        {{ __('Matching') }}
                                                                    </span>
                                                                @break
                                    
                                                                @case(0)
                                                                    <span class="badge rounded p-2 f-w-600 bg-light-danger">
                                                                        {{ __('Not Matching') }}
                                                                    </span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @switch($criterion->fulfillment_status)
                                                                @case('1')
                                                                    <span class="badge rounded p-2 f-w-600 bg-light-danger">
                                                                        {{ __('Not Fulfilled') }}
                                                                    </span>
                                                                @break

                                                                @case('2')
                                                                    <span
                                                                        class="badge rounded p-2 f-w-600 bg-light-warning">{{ __('Partially Fulfilled') }}</span>
                                                                @break

                                                                @case('3')
                                                                    <span class="badge rounded p-2 f-w-600 bg-light-info">{{ __('Fulfilled') }}</span>
                                                                @break

                                                                @case('4')
                                                                    <span class="badge rounded p-2 f-w-600 bg-light-primary">{{ __('Fulfilled with Excellence') }}</span>
                                                                @break

                                                                @case('5')
                                                                    <span class="badge rounded p-2 f-w-600 bg-light-success">{{ __('Fulfilled with Distinction') }}</span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="{{ route('criteria.show', $criterion->id) }}"
                                                                    class="btn btn-sm btn-light"
                                                                    title="{{ __('View Details') }}">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                                @can('Edit Criteria')
                                                                    <a href="{{ route('criteria.edit', $criterion->id) }}"
                                                                        class="btn btn-sm btn-light"
                                                                        title="{{ __('Edit') }}">
                                                                        <i class="ti ti-edit"></i>
                                                                    </a>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center py-4">
                                                            <img src="{{ asset('assets/images/empty.svg') }}"
                                                                alt="Empty" class="mb-3" style="max-width: 120px;">
                                                            <h6 class="text-muted">{{ __('No Criteria Found') }}</h6>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar Information -->
                        <div class="col-md-4">
                            <!-- Assigned Users -->
                            <div class="card shadow-none border mb-4">
                                <div class="card-header bg-transparent">
                                    <h5 class="mb-0">
                                        <i class="ti ti-users me-2"></i>{{ __('Assigned Users') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if ($standard->users->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach ($standard->users as $user)
                                                <div class="list-group-item px-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-3">
                                                            @if ($user->profile)
                                                                <img src="{{ asset(Storage::url('upload/profile/' . $user->profile)) }}"
                                                                    class="rounded-circle">
                                                            @else
                                                                <span class="avatar-text rounded-circle bg-primary">
                                                                    {{ strtoupper(substr($user->full_name, 0, 1)) }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $user->full_name }}</h6>
                                                            <small class="text-muted">{{ $user->email }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-3">
                                            <img src="{{ asset('assets/images/empty.svg') }}" class="mb-3"
                                                style="max-width: 120px;">
                                            <h6 class="text-muted">{{ __('No Users Assigned') }}</h6>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Statistics Card -->
                            <div class="card shadow-none border">
                                <div class="card-header bg-transparent">
                                    <h5 class="mb-0">
                                        <i class="ti ti-chart-bar me-2"></i>{{ __('Statistics') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="p-3 bg-light rounded">
                                                <h6 class="mb-1">{{ $standard->criteria->count() }}</h6>
                                                <small class="text-muted">{{ __('Total Criteria') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-3 bg-light rounded">
                                                <h6 class="mb-1">{{ $standard->users->count() }}</h6>
                                                <small class="text-muted">{{ __('Assigned Users') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-3 bg-light rounded">
                                                <h6 class="mb-1">
                                                    {{ $standard->criteria->where('is_met', 1)->count() }}</h6>
                                                <small class="text-muted">{{ __('Matching') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-3 bg-light rounded">
                                                <h6 class="mb-1">
                                                    {{ $standard->criteria->where('is_met', 0)->count() }}</h6>
                                                <small class="text-muted">{{ __('Not Matching') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css-page')
    <style>
        .avatar-text {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
            color: #fff;
        }

        .list-group-item {
            border-left: 0;
            border-right: 0;
        }

        .list-group-item:first-child {
            border-top: 0;
        }

        .list-group-item:last-child {
            border-bottom: 0;
        }
    </style>
@endpush
