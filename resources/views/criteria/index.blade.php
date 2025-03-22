@extends('layouts.admin')
@section('page-title')
    {{ __('Criteria') }}
@endsection
@php
    $logo = \App\Models\Utility::get_file('uploads/is_cover_image/');
@endphp
@section('title')
    {{ __('Criteria') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Criteria') }}</li>
@endsection
@section('action-btn')
    <div class="row gy-4 align-items-center ">
        <div class="col-auto">
            <div class="d-flex">
                {{-- <a href="" class="btn btn-sm btn-icon  bg-light-secondary me-2" data-bs-toggle="tooltip"
                    data-bs-original-title="{{ __('Export') }}">
                    <i data-feather="download"></i>
                </a>
                
                    <a class="btn btn-sm btn-icon  bg-light-secondary me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="{{ __('Import') }}" data-size="md" data-ajax-popup="true"
                    data-title="{{ __('Import Product CSV file') }}" data-url="">
                    <i data-feather="upload"></i>
                    </a> 
                --}}
                <a class="btn btn-sm btn-icon text-white  btn-primary me-2" data-url="{{ route('criteria.create') }}"
                    data-title="{{ __('Add Criterion') }}" data-ajax-popup="true" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="{{ __('Add Criterion') }}">
                    <i data-feather="plus"></i>
                </a>
                {{-- <a href="{{ route('criteria.create') }}" class="btn btn-sm btn-icon text-white btn-primary me-2"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Create') }}">
                        <i data-feather="plus"></i>
                    </a> --}}
                {{-- <a href="{{ route('main-standards.grid') }}" class="btn btn-sm btn-icon  bg-light-secondary"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Grid View') }}">
                    <i class="ti ti-grid-dots f-30"></i>
                </a> --}}
            </div>
        </div>
    </div>
@endsection
@section('filter')
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{ asset('custom/libs/summernote/summernote-bs4.css') }}">
@endpush
@push('script-page')
    <script src="{{ asset('custom/libs/summernote/summernote-bs4.js') }}"></script>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('Name (Arabic)') }}</th>
                                    <th>{{ __('Name (English)') }}</th>
                                    <th>{{ __('Standard') }}</th>
                                    <th>{{ __('Compliance') }}</th>
                                    <th>{{ __('Fulfillment Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criteria as $criterion)
                                    <tr>
                                        <td>{{ $criterion->name_ar }}</td>
                                        <td>{{ $criterion->name_en }}</td>
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
                                            <a href="{{ route('criteria.show', $criterion->id) }}"
                                                class="btn btn-sm btn-info">{{ __('Manage') }}</a>
                                            <a href="{{ route('criteria.edit', $criterion->id) }}"
                                                class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                            <form action="{{ route('criteria.destroy', $criterion->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('{{ __('Are you sure you want to delete this Criterion?') }}')">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
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
@push('script-page')
    <script>
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        })
    </script>
@endpush
