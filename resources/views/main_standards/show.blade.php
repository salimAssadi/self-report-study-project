@extends('layouts.admin')
@section('page-title')
    {{ __('Standard Detail') }}
@endsection
@section('title')
    {{ __('Standard Detail') }}
@endsection
@php
    $logo = \App\Models\Utility::get_file('uploads/is_cover_image/');
    $p_logo = \App\Models\Utility::get_file('uploads/product_image/');
@endphp
@section('action-btn')
    @can('Edit Products')
        <div class="row  m-1">
            <div class="col-12 pe-0">
                <a href="{{ route('main-standards.edit', $mainStandard->id) }}" class="btn btn-sm btn-primary btn-icon"
                    class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="{{ __('Edit Standard') }}"><i class="ti ti-edit text-white"></i></a>
            </div>
        </div>
    @endcan
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>

    <li class="breadcrumb-item"><a href="{{ route('main-standards.index') }}">{{ __('MainStandard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Standard Detail') }}</li>
@endsection
@section('content')
    <div class="row card mt-2 mx-1">
        <ul class="nav nav-tabs nav-fill w-25" id="mainStandardTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="ar-tab" data-bs-toggle="tab" data-bs-target="#ar-content"
                    type="button" role="tab" aria-controls="ar-content"
                    aria-selected="true">{{ __('Arabic') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-content" type="button"
                    role="tab" aria-controls="en-content" aria-selected="false">{{ __('English') }}</button>
            </li>
        </ul>
        <div class="tab-content" id="mainStandardTabsContent">
            <!-- Arabic Content -->
            <div class="tab-pane fade show active" id="ar-content" role="tabpanel" aria-labelledby="ar-tab">
                <div class="card shadow-none border border-primary mt   -3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $mainStandard->name_ar }}</h5>
                        <p class=""><strong>{{ __('Sequence') }}:</strong>
                            {{ $mainStandard->sequence }}
                            <hr>
                        </p>
                        <p>
                            <strong>{{ __('Introduction (Arabic)') }}:</strong>
                            {!! $mainStandard->introduction_ar !!}
                        </p>
                        <hr>
                        <p>
                            <strong>{{ __('Description (Arabic)') }}:</strong>
                            {!! $mainStandard->description_ar !!}
                        </p>
                        <hr>
                        <p>
                            <strong>{{ __('Summary (Arabic)') }}:</strong>
                            {!! $mainStandard->summary_ar !!}
                        </p>
                    </div>
                </div>
            </div>

            <!-- English Content -->
            <div class="tab-pane fade" id="en-content" role="tabpanel" aria-labelledby="en-tab">
                <div class="card shadow-none border border-primary mt-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $mainStandard->name_en }}</h5>
                        <p class=""><strong>{{ __('Sequence') }}:</strong>
                            {{ $mainStandard->sequence }}
                            <hr>
                        </p>
                        <p>
                            <strong>{{ __('Introduction (English)') }}:</strong>
                            {!! $mainStandard->introduction_en !!}
                        </p>
                        <hr>
                        <p>
                            <strong>{{ __('Description (English)') }}:</strong>
                            {!! $mainStandard->description_en !!}
                        </p>
                        <hr>
                        <p>
                            <strong>{{ __('Summary (English)') }}:</strong>
                            {!! $mainStandard->summary_en !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{-- <div class="row"> --}}
            <!-- Sub-Standards Table -->
            {{-- <h2>{{ __('Sub-Standards') }}</h2> --}}
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('N') }}</th>
                                    <th>{{ __('Sequence') }}</th>
                                    <th>{{ __('Name ar') }}</th>
                                    <th>{{ __('Name en') }}</th>
                                    <th>{{ __('Number of Criteria') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($subStandards->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">{{ __('No Sub-Standards found.') }}</td>
                                    </tr>
                                @else
                                    @foreach ($subStandards as $subStandard)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subStandard->main_standard_id . '.' . $subStandard->sequence }}</td>
                                            <td>{{ $subStandard->name_ar }}</td>
                                            <td>{{ $subStandard->name_en }}</td>
                                            <td>{{ $subStandard->criteria->count() }}</td>
                                            <td>
                                                <a href="{{ route('sub-standards.show', $subStandard->id) }}"
                                                    class="btn btn-sm btn-icon  bg-light-secondary me-2">
                                                    <i class="ti ti-eye f-20"></i>
                                                </a>
                                                <a href="{{ route('sub-standards.edit', $subStandard->id) }}"
                                                    class="btn btn-sm btn-icon bg-light-secondary me-2">
                                                    <i class="ti ti-edit f-20"></i> </a>
                                                <form action="{{ route('sub-standards.destroy', $subStandard->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class=" show_confirm btn btn-sm btn-icon bg-light-secondary me-2"
                                                        href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ __('Delete') }}">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
            <!-- [ sample-page ] end -->
        </div>
    @endsection

    @push('script-page')
    @endpush
