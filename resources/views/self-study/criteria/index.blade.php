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
            0% {
                transform: translate(0);
            }

            25% {
                transform: translate(-2px, 2px);
            }

            50% {
                transform: translate(2px, -2px);
            }

            75% {
                transform: translate(-2px, -2px);
            }

            100% {
                transform: translate(0);
            }
        }

        .vibrate {
            animation: vibrate 0.5s infinite;
        }
        .table thead td {
         font-weight: bold !important;
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
                    <form action="{{ route('criteria.index') }}" method="get" class="mb-4">
                        <div class="card px-3">

                            <div class="card-body">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-5">
                                        <label for="main_standard_id" class="form-label fw-bold">{{ __('Parent Standard') }}</label>
                                        <select name="main_standard_id" id="main_standard_id" class="form-select form-select-lg">
                                            <option value="">{{ __('Select Parent Standard') }}</option>
                                            @foreach($mainStandards as $mainStandard)
                                                <option value="{{ $mainStandard->id }}"
                                                    {{ request('main_standard_id') == $mainStandard->id ? 'selected' : '' }}>
                                                    {{ $mainStandard->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="sub_standard_id" class="form-label fw-bold">{{ __('Sub-Standard') }}</label>
                                        <select name="sub_standard_id" id="sub_standard_id" class="form-select form-select-lg">
                                            <option value="">{{ __('All Sub-Standards') }}</option>
                                            @foreach($subStandards ?? [] as $subStandard)
                                                <option value="{{ $subStandard->id }}"
                                                    {{ request('sub_standard_id') == $subStandard->id ? 'selected' : '' }}>
                                                    {{ $subStandard->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="fas fa-filter me-2"></i>{{ __('Filter') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Sequence') }}</th>
                                    <th>{{ __('Name') }}</th>

                                    <th>{{ __('Standard') }}</th>
                                    <th>{{ __('Sub-Standard') }}</th>
                                    <th>{{ __('Compliance') }}</th>
                                    <th>{{ __('Fulfillment Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criteria as $criterion)
                                    <tr>
                                        <td>{{ toArabicNumbers($criterion->sequence) }}</td>
                                        <td>{{ $criterion->name }}</td>
                                        <td>
                                            {{ $criterion->standard?->parent?->name ?? ($criterion->standard?->parent?->name ?? '-') }}
                                        </td>
                                        <td>
                                            {{ $criterion->standard?->name ?? ($criterion->standard?->name ?? '-') }}
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
                                                @if (Gate::check('Show Criteria'))
                                                    <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                        href="{{ route('criteria.show', $criterion->id) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ __('View') }}">
                                                        <i class="ti ti-eye f-20"></i>
                                                    </a>
                                                @endif

                                                <!-- Edit Button -->
                                                @if (Gate::check('Edit Criteria'))
                                                    <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                        href="{{ route('criteria.edit', $criterion->id) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ __('Edit') }}">
                                                        <i class="ti ti-edit f-20"></i>
                                                    </a>
                                                @endif

                                                <!-- Delete Button -->
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['criteria.destroy', $criterion->id],
                                                    'id' => 'delete-form-' . $criterion->id,
                                                ]) !!}
                                                @if (Gate::check('Delete Criteria'))
                                                    <a class="show_confirm btn btn-sm btn-icon bg-light-secondary me-2 confirm_dialog"
                                                        href="#" data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                        data-confirm="{{ __('Are You Sure?') }}"
                                                        data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="delete-form-{{ $criterion->id }}">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>
                                                @endif
                                                @if (Gate::check('Show Comments'))
                                                    <a class="avtar avtar-xs btn-link-danger text-danger me-2 "
                                                        href="{{ route('criterion.comments.index', $criterion->id) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ __('Comments') }}">
                                                        <i class="ti ti-message text-danger  f-20"></i>
                                                        <span
                                                            class="text-danger">{{ $criterion->comments->count() }}</span>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const mainStandardDropdown = $('#main_standard_id');
        const subStandardDropdown = $('#sub_standard_id');

        // Fetch sub-standards for the selected main standard
        mainStandardDropdown.on('change', function() {
            const mainStandardId = mainStandardDropdown.val();

            // Clear existing options in the sub-standard dropdown
            subStandardDropdown.empty();
            subStandardDropdown.append('<option value="">{{ __('Select Sub-Standard') }}</option>');

            if (mainStandardId) {
                $.ajax({
                    url: "{{ route('api.standards.children') }}", // Combine route() with dynamic ID
                    method: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        parent_id: mainStandardId
                    },
                    success: function(data) {
                        if (data.length === 0) {
                            // If no sub-standards are found, show a placeholder option
                            subStandardDropdown.append(
                                '<option value="" disabled>{{ __('No Sub-Standards Available') }}</option>'
                                );
                        } else {
                            // Populate the dropdown with sub-standards
                            data.forEach(function(subStandard) {
                                const option = $('<option>', {
                                    value: subStandard.id,
                                    text:  subStandard.name,
                                });
                                subStandardDropdown.append(option);
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching sub-standards:', error);
                        // Show an error message in the dropdown if the request fails
                        subStandardDropdown.append(
                            '<option value="" disabled>{{ __('Error Loading Sub-Standards') }}</option>'
                            );
                    },
                });
            }
        });
    });
</script>
