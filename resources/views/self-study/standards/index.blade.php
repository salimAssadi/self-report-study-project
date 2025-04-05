@extends('layouts.admin-app')
@php
    $profile = asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
    {{ __('Manage Standards') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        {{ __('Manage Standards') }}

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
                                {{ __('Manage Standards') }}
                            </h5>
                        </div>
                        <div class="col-auto">
                            @if (Gate::check('Create Standard'))
                                <a href="{{ route('admin.standards.create') }}" class="btn btn-secondary customModal"
                                    data-size="lg" data-url="{{ route('admin.standards.create') }}"
                                    data-title="{{ __('Create Standard') }}">

                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Standard') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">

                    <div class="dt-responsive table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>

                                    <th>{{ __('Sequence') }}</th>
                                    <th>{{ __('Name (Arabic)') }}</th>
                                    <th>{{ __('Name (English)') }}</th>
                                    <th>{{ __('Sub-Standards Count') }}</th>
                                    <th>{{ __('Number of Criteria') }}</th>
                                    <th>{{ __('Completion Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($standards as $standard)
                                    <!-- Parent Row -->
                                    <tr>
                                        <td>{{ $standard->sequence }}</td>
                                        <td>{{ $standard->name_ar }}</td>
                                        <td>{{ $standard->name_en }}</td>
                                        <td>{{ $standard->children->count() }}</td>
                                        <td>{{ $standard->criteria->count() }}</td>
                                        <td>
                                            @switch($standard->completion_status)
                                                @case('incomplete')
                                                    <span
                                                        class="badge rounded p-2 f-w-600 bg-light-danger">{{ __('Incomplete') }}</span>
                                                @break

                                                @case('partially_completed')
                                                    <span
                                                        class="badge rounded p-2 f-w-600 bg-light-warning">{{ __('Partially Complete') }}</span>
                                                @break

                                                @case('completed')
                                                    <span
                                                        class="badge rounded p-2 f-w-600 bg-light-success">{{ __('Complete') }}</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <!-- View Button -->
                                                @if (Gate::check('Show Standard'))
                                                    <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                        href="{{ route('admin.standards.show', $standard->id) }}"
                                                        data-bs-toggle="tooltip" title="{{ __('View') }}">
                                                        <i class="ti ti-eye f-20"></i>
                                                    </a>
                                                @endif
                                                <!-- Edit Button -->
                                                @if (Gate::check('Edit Standard'))
                                                    <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                        href="{{ route('admin.standards.edit', $standard->id) }}"
                                                        data-bs-toggle="tooltip" title="{{ __('Edit') }}">
                                                        <i class="ti ti-edit f-20"></i>
                                                    </a>
                                                @endif
                                                @if (Gate::check('Delete Standard'))
                                                    <!-- Delete Button -->
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['admin.standards.destroy', $standard->id],
                                                        'id' => 'delete-form-' . $standard->id,
                                                    ]) !!}
                                                    <a class="show_confirm btn btn-sm btn-icon bg-light-secondary me-2"
                                                        href="#" data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                        onclick="event.preventDefault(); if(confirm('{{ __('Are you sure?') }}')) document.getElementById('delete-form-{{ $standard->id }}').submit();">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>
                                                    {!! Form::close() !!}
                                                @endif
                                                @if ($standard->children->isNotEmpty())
                                                    <button
                                                        class="bg-light-secondary btn btn-rounded btn-sm btn-small mb-3 rounded-3 toggle-children"
                                                        data-target="#children-{{ $standard->id }}">
                                                        {{ __('Show SubStandard') }}
                                                    </button>
                                                @endif
                                                @if ($standard->criteria->isNotEmpty())
                                                    @if (Gate::check('Manage Criteria'))
                                                        <button
                                                            class="bg-light-secondary btn btn-rounded btn-sm btn-small mb-3 rounded-3 toggle-criteria"
                                                            data-target="#criteria-{{ $standard->id }}">
                                                            {{ __('Show Criterion') }}
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Include Child Rows -->
                                    @include('self-study.standards._children', ['standard' => $standard])
                                    <!-- Criteria Section for Main Standards -->
                                    <tr class="collapse" id="criteria-{{ $standard->id }}">
                                        <td colspan="10">
                                            <h5 class="mb-3">{{ __('Criteria for ') . $standard->name_en }}</h5>
                                            @include('self-study.standards._criteria', [
                                                'criteria' => $standard->criteria,
                                            ])
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
        // Toggle Children on Button Click
        $('.toggle-children').on('click', function() {
            const target = $(this).data('target');
            const icon = $(this).find('i');

            $(target).collapse('toggle'); // Toggle collapse/expand

            // Update Icon
            if ($(target).hasClass('show')) {
                icon.removeClass('ti-chevron-down').addClass('ti-chevron-up');
            } else {
                icon.removeClass('ti-chevron-up').addClass('ti-chevron-down');
            }
        });

        // Toggle Criteria on Button Click
        $('.toggle-criteria').on('click', function() {
            const target = $(this).data('target');
            const icon = $(this).find('i');

            $(target).collapse('toggle'); // Toggle collapse/expand

            // Update Icon
            if ($(target).hasClass('show')) {
                icon.removeClass('ti-chevron-down').addClass('ti-chevron-up');
            } else {
                icon.removeClass('ti-chevron-up').addClass('ti-chevron-down');
            }
        });
    });
</script>
