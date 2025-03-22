@extends('layouts.admin')
@section('page-title')
    {{ __('MainStandard') }}
@endsection
@php
    $logo = \App\Models\Utility::get_file('uploads/is_cover_image/');
@endphp
@section('title')
    {{ __('MainStandard') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('MainStandard') }}</li>
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
                </a> --}}

                <a href="{{ route('main-standards.create') }}" class="btn btn-sm btn-icon text-white btn-primary me-2"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Create') }}">
                    <i data-feather="plus"></i>
                </a>
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

                                    <th>{{ __('N') }}</th>
                                    <th>{{ __('Name ar') }}</th>
                                    <th>{{ __('Name en') }}</th>
                                    {{-- <th>{{ __('Description ar') }}</th> --}}
                                    {{-- <th>{{ __('Description en') }}</th> --}}
                                    <th>{{ __('Sequence') }}</th>
                                    <th>{{ __('Sub-Standards Count') }}</th>
                                    <th>{{ __('Completion Status') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th class="text-right" width="200px">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mainStandards as $mainStandard)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mainStandard->name_ar }}</td>

                                        <td>{{ $mainStandard->name_en }}</td>

                                        {{-- <td>{{ Str::limit($mainStandard->description_ar, 50) }}</td> --}}

                                        {{-- <td>{{ Str::limit($mainStandard->description_en, 50) }}</td> --}}

                                        <td>{{ $mainStandard->sequence }}</td>

                                        <td>{{ $mainStandard->subStandards->count() }}</td>
                                        <td>
                                            @switch($mainStandard->completion_status)
                                                @case('incomplete')
                                                    <span class="badge rounded p-2 f-w-600 bg-light-danger">
                                                        {{ __('Incomplete') }}
                                                    </span>
                                                @break

                                                @case('partially_complete')
                                                    <span class="badge rounded p-2 f-w-600 bg-light-warning">
                                                        {{ __('Partially Complete') }}
                                                    </span>
                                                @break

                                                @case('complete')
                                                    <span class="badge rounded p-2 f-w-600 bg-light-success">
                                                        {{ __('Complete') }}
                                                    </span>
                                                @break
                                            @endswitch
                                        </td>
                                        <!-- Created At -->
                                        <td>{{ \App\Models\Utility::dateFormat($mainStandard->created_at) }}</td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="d-flex">
                                                <!-- View Button -->
                                                <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                    href="{{ route('main-standards.show', $mainStandard->id) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('View') }}">
                                                    <i class="ti ti-eye f-20"></i>
                                                </a>

                                                <!-- Edit Button -->
                                                <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                    href="{{ route('main-standards.edit', $mainStandard->id) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('Edit') }}">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['main-standards.destroy', $mainStandard->id],
                                                    'id' => 'delete-form-' . $mainStandard->id,
                                                ]) !!}
                                                <a class="show_confirm btn btn-sm btn-icon bg-light-secondary me-2"
                                                    href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('Delete') }}">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>
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
