@extends('layouts.admin-app')
@php
$profile = asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
{{ __('Criteria') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
</li>
<li class="breadcrumb-item" aria-current="page">
    {{ __('Criteria') }}

</li>
@endsection
@push('css-page')
<style>
@keyframes vibrate {
    0% { transform: translate(0); }
    25% { transform: translate(-2px, 2px); }
    50% { transform: translate(2px, -2px); }
    75% { transform: translate(-2px, -2px); }
    100% { transform: translate(0); }
}

.vibrate {
    animation: vibrate 0.5s infinite;
}
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card table-card">
            <div class="card-header">
                <div class="row align-items-center g-2">
                    <div class="col">
                        <h5>
                            {{ __('Criteria') }}
                        </h5>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="btn btn-secondary customModal" data-size="lg"
                            data-url="{{ route('criteria.create') }}" data-title="{{ __('Create Criterion') }}">

                            <i class="ti ti-circle-plus align-text-bottom"></i>
                            {{ __('Create Criterion') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="dt-responsive table-responsive">
                    <table class="table table-hover advance-datatable">
                        <thead>
                            <tr>
                                <th>{{ __('Sequence') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Standard') }}</th>
                                <th>{{ __('Compliance') }}</th>
                                <th>{{ __('Fulfillment Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($criteria as $criterion)
                            <tr>
                                <td>{{ $criterion->sequence }}</td>
                                <td>{{ $criterion->name }}</td>
                                <td>
                                    {{ $criterion->standard?->name_ar ?? ($criterion->standard?->name_en ?? '-') }}
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
                                    <span class="badge rounded p-2 f-w-600 bg-light-warning">
                                        {{ __('Partially Fulfilled') }}
                                    </span>
                                    @break

                                    @case('3')
                                    <span class="badge rounded p-2 f-w-600 bg-light-info">
                                        {{ __('Fulfilled') }}
                                    </span>
                                    @break

                                    @case('4')
                                    <span class="badge rounded p-2 f-w-600 bg-light-primary">
                                        {{ __('Fulfilled with Excellence') }}
                                    </span>
                                    @break

                                    @case('5')
                                    <span class="badge rounded p-2 f-w-600 bg-light-success">
                                        {{ __('Fulfilled with Distinction') }}
                                    </span>
                                    @break
                                    @endswitch
                                </td>



                               
                                <td>
                                    <div class="d-flex">
                                        <!-- View Button -->
                                        <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                            href="{{ route('criteria.show', $criterion->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('View') }}">
                                            <i class="ti ti-eye f-20"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                            href="{{ route('criteria.edit', $criterion->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Edit') }}">
                                            <i class="ti ti-edit f-20"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['criteria.destroy', $criterion->id],
                                            'id' => 'delete-form-' . $criterion->id,
                                        ]) !!}
                                        <a class="show_confirm btn btn-sm btn-icon bg-light-secondary me-2"
                                            href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Delete') }}">
                                            <i class="ti ti-trash f-20"></i>
                                        </a>
                                        @if(Gate::check('Show Comments'))
                                        <a class="avtar avtar-xs btn-link-danger text-danger me-2 vibrate"
                                           href="{{ route('criterion.comments.index', $criterion->id) }}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           title="{{ __('Comments') }}">
                                           @if($criterion->comments->count() > 0)
                                           <i class="ti ti-message text-danger vibrate f-20"></i>
                                                <span class="text-danger">{{ $criterion->comments->count() }}</span>
                                            @endif
                                        </a>
                                    @endif
                                        {!! Form::close() !!}
                                    </div>
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