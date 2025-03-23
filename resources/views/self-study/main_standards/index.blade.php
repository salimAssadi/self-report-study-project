@extends('layouts.admin-app')
@php
    $profile = asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
    {{ __('Create Standard') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        {{ __('Create Standard') }}

    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>
                                {{ __('Create Standard') }}
                            </h5>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('admin.main-standards.create') }}" class="btn btn-secondary customModal" data-size="lg"
                                data-url="" data-title="{{ __('Create Standard') }}">

                                <i class="ti ti-circle-plus align-text-bottom"></i>
                                {{ __('Create Standard') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
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
                                        <td>{{ $mainStandard->created_at }}</td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="d-flex">
                                                <!-- View Button -->
                                                <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                    href="{{ route('admin.main-standards.show', $mainStandard->id) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('View') }}">
                                                    <i class="ti ti-eye f-20"></i>
                                                </a>

                                                <!-- Edit Button -->
                                                <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                    href="{{ route('admin.main-standards.edit', $mainStandard->id) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('Edit') }}">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['admin.main-standards.destroy', $mainStandard->id],
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
