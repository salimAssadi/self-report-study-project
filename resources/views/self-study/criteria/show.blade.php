@extends('layouts.admin-app')
@php
    $profile = asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
    {{ __('Criteria') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        {{ __('Criteria') }}

    </li>
@endsection
@push('script-page')
    <script src="{{ asset('assets/js/plugins/tinymce/tinymce.min.js') }}"></script>
    
@endpush
@section('content')
    <div class="row d-none">
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
                                data-url="{{ route('admin.criteria.create') }}" data-title="{{ __('Create Criterion') }}">

                                <i class="ti ti-circle-plus align-text-bottom"></i>
                                {{ __('Criteria') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3 align-items-center gap-2 flex-sm-row flex-column justify-content-between">
                        <h4 style="width: 80%;">{{ $criteria->name_ar }}</h4>
                        <div class="ps-3 d-flex align-items-center ">
                            @switch($criteria->fulfillment_status)
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
                            <div class="text-end ms-3">
                                @if ($criteria->is_met == '1')
                                    <span class="badge rounded p-2 f-w-600  bg-light-info">
                                        {{ __('Matching') }}
                                    </span>
                                @else
                                    <span class="badge rounded p-2 f-w-600  bg-light-danger">
                                        {{ __('Not Matching') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="border  mb-4 rounded border-primary"></p>
                    <p class="mb-2">{{ __('Description') }}:</p>
                    <p> </p>
                </div>


                <div class="col-lg-6 d-none">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4>{{ __('Express Checkout') }}</h4>
                                        <small
                                            class="text-dark font-weight-bold">{{ __('Note:Create Express Checkout Url For Direct Order') }}</small>
                                    </div>
                                    <a href="#" class="btn btn-primary" data-ajax-popup="true"
                                        data-url="{{ route('admin.criteria.create', [$criteria->id]) }}"
                                        data-title="{{ __('Add Product') }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ __('Create') }}" data-tooltip="Create">
                                        {{ __('Add') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table mb-0 pc-dt-simple" id="pc-dt-simple">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Quantity') }}</th>
                                                <th>{{ __('Variant Name') }}</th>
                                                <th>{{ __('URL') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 gx-3">
                        <div class="col-sm-6">
                            <div class="card border  shadow-none">
                                <div class="card-body">
                                    <h4>{{ __('Color') }}</h4>
                                    <div class="row align-items-center">
                                        <input type="hidden" id="product_id">
                                        <input type="hidden" id="variant_id" value="">
                                        <input type="hidden" id="variant_qty" value="">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border  shadow-none">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 mb-4 mb-sm-0">
                                            <span class="d-block h6 mb-0">
                                                <span class="d-block h3 mb-0 variasion_price">


                                                </span>
                                            </span>
                                        </div>
                                        <div class="col-sm-6 mb-4 mb-sm-0 text-end">
                                            <span class="d-block h6 mb-0">
                                                <button type="button" class="btn btn-primary btn-icon">
                                                    <span class="btn-inner--icon variant_qty">

                                                    </span>
                                                    <span class="btn-inner--text">
                                                        {{ __('Total Avl.Quantity') }}
                                                    </span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border  shadow-none">
                        <div class="card-header">
                            <h4>{{ __('Gallery') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3 gx-3">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
@endsection
