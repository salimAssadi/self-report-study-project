@extends('layouts.admin-app')
@section('page-title')
    {{ __('Facility Info') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Facility Info') }}</li>
@endsection
@php
    $admin_logo = getSettingsValByName('company_logo');
    $profile = asset(Storage::url('upload/profile'));
    $activeTab = session('tab', 'user_profile_settings');
@endphp


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>
                                {{ __('Facility Info') }}
                            </h5>
                        </div>
                        <div class="col-auto">

                            <a href="{{ route('admin.home') }}" class="btn btn-light-secondary me-3"> <i
                                    data-feather="x-circle" class="me-2"></i>{{ __('Cancel') }}</a>
                            <a type="submit" id="submit-all" class="btn btn-primary text-white"> <i
                                    data-feather="check-circle" class="me-2"></i>{{ __('Save') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-5">
                    <form action="{{ route('admin.setting.savefacilityInfo') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                       

                                <!-- Tabs -->
                                <ul class="nav nav-tabs w-25" id="facilityTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="arabic-tab" data-bs-toggle="tab"
                                            data-bs-target="#arabic" type="button" role="tab" aria-controls="arabic"
                                            aria-selected="true">{{ __('Arabic') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="english-tab" data-bs-toggle="tab"
                                            data-bs-target="#english" type="button" role="tab" aria-controls="english"
                                            aria-selected="false">{{ __('English') }}</button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content mt-3" id="facilityTabsContent">
                                    <!-- Arabic Tab -->
                                    <div class="tab-pane fade show active" id="arabic" role="tabpanel"
                                        aria-labelledby="arabic-tab">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Facility Name (Arabic)') }}</label>
                                            <input type="text" name="facility_name_ar" class="form-control"
                                                value="{{ $settings['facility_name_ar'] ?? '' }}"
                                                placeholder="{{ __('Enter Facility Name (Arabic)') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Vision (Arabic)') }}</label>
                                            <textarea name="vision_ar" class="form-control summernote" rows="3"
                                                placeholder="{{ __('Enter Vision (Arabic)') }}">{{ $settings['vision_ar'] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Goals (Arabic)') }}</label>
                                            <textarea name="goals_ar" class="form-control summernote" rows="3"
                                                placeholder="{{ __('Enter Goals (Arabic)') }}">{{ $settings['goals_ar'] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Report Guidelines (Arabic)') }}</label>
                                            <textarea name="report_guidelines_ar" class="form-control summernote" rows="3"
                                                placeholder="{{ __('Enter Report Guidelines (Arabic)') }}">{{ $settings['report_guidelines_ar'] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Contact Name (Arabic)') }}</label>
                                            <input type="text" name="contact_name_ar" class="form-control"
                                                value="{{ $settings['contact_name_ar'] ?? '' }}"
                                                placeholder="{{ __('Enter Contact Name (Arabic)') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Contact Position (Arabic)') }}</label>
                                            <input type="text" name="contact_position_ar" class="form-control"
                                                value="{{ $settings['contact_position_ar'] ?? '' }}"
                                                placeholder="{{ __('Enter Contact Position (Arabic)') }}">
                                        </div>
                                    </div>

                                    <!-- English Tab -->

                                    <div class="tab-pane fade" id="english" role="tabpanel" aria-labelledby="english-tab">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Facility Name (English)') }}</label>
                                            <input type="text" name="facility_name_en" class="form-control"
                                                value="{{ $settings['facility_name_en'] ?? '' }}"
                                                placeholder="{{ __('Enter Facility Name (English)') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Vision (English)') }}</label>
                                            <textarea name="vision_en" class="form-control summernote" rows="3"
                                                placeholder="{{ __('Enter Vision (English)') }}">{{ $settings['vision_en'] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Goals (English)') }}</label>
                                            <textarea name="goals_en" class="form-control summernote" rows="3"
                                                placeholder="{{ __('Enter Goals (English)') }}">{{ $settings['goals_en'] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Report Guidelines (English)') }}</label>
                                            <textarea name="report_guidelines_en" class="form-control summernote" rows="3"
                                                placeholder="{{ __('Enter Report Guidelines (English)') }}">{{ $settings['report_guidelines_en'] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Contact Name (English)') }}</label>
                                            <input type="text" name="contact_name_en" class="form-control"
                                                value="{{ $settings['contact_name_en'] ?? '' }}"
                                                placeholder="{{ __('Enter Contact Name (English)') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Contact Position (English)') }}</label>
                                            <input type="text" name="contact_position_en" class="form-control"
                                                value="{{ $settings['contact_position_en'] ?? '' }}"
                                                placeholder="{{ __('Enter Contact Position (English)') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Shared Fields (Common for Both Languages) -->
                                <div class="row mt-3">

                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{ __('Report Date') }}</label>
                                        <input type="date" name="report_date" class="form-control"
                                            value="{{ $settings['report_date'] ?? '' }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{ __('Report Preparer Name') }}</label>
                                        <input type="text" name="report_preparer_name" class="form-control"
                                            value="{{ $settings['report_preparer_name'] ?? '' }}"
                                            placeholder="{{ __('Enter Report Preparer Name') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{ __('Contact Email') }}</label>
                                        <input type="email" name="contact_email" class="form-control"
                                            value="{{ $settings['contact_email'] ?? '' }}"
                                            placeholder="{{ __('Enter Contact Email') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label">{{ __('Contact Phone') }}</label>
                                        <input type="text" name="contact_phone" class="form-control"
                                            value="{{ $settings['contact_phone'] ?? '' }}"
                                            placeholder="{{ __('Enter Contact Phone') }}">
                                    </div>
                                </div>
                            
                        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script-page')
    <script src="{{ asset('assets/js/plugins/tinymce/tinymce.min.js') }}"></script>
    
@endpush