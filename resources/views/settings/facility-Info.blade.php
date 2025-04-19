@extends('layouts.admin-app')
@section('page-title')
    {{ __('Facility Info') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Facility Info') }}</li>
@endsection
@push('script-page')
    <script src="{{ asset('assets/js/plugins/tinymce/tinymce.min.js') }}"></script>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary mt-3">
                    <div class="card-header">{{ __('Facility Info') }}</div>

                    <div class="card-body">
                        <div class="accordion" id="selfReportAccordion">
                            <!-- Institution Profile -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        {{ __('Institution Profile') }}
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form action="{{ route('setting.saveSelfReport') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="section" value="institution_profile">

                                            <!-- Tabs -->
                                            <ul class="nav nav-tabs w-25" id="facilityTabs" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="arabic-tab" data-bs-toggle="tab"
                                                        data-bs-target="#arabic" type="button" role="tab"
                                                        aria-controls="arabic"
                                                        aria-selected="true">{{ __('Arabic') }}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="english-tab" data-bs-toggle="tab"
                                                        data-bs-target="#english" type="button" role="tab"
                                                        aria-controls="english"
                                                        aria-selected="false">{{ __('English') }}</button>
                                                </li>
                                            </ul>

                                            <!-- Tab Content -->
                                            <div class="tab-content mt-3" id="facilityTabsContent">
                                                <!-- Arabic Tab -->
                                                <div class="tab-pane fade show active" id="arabic" role="tabpanel"
                                                    aria-labelledby="arabic-tab">
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('Facility Name (Arabic)') }}</label>
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
                                                        <label
                                                            class="form-label">{{ __('Message Facility (Arabic)') }}</label>
                                                        <textarea name="messages_ar" class="form-control summernote" rows="3"
                                                            placeholder="{{ __('Enter Message Facility (Arabic)') }}">{{ $settings['messages_ar'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Contact Name (Arabic)') }}</label>
                                                        <input type="text" name="contact_name_ar" class="form-control"
                                                            value="{{ $settings['contact_name_ar'] ?? '' }}"
                                                            placeholder="{{ __('Enter Contact Name (Arabic)') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('Contact Position (Arabic)') }}</label>
                                                        <input type="text" name="contact_position_ar"
                                                            class="form-control"
                                                            value="{{ $settings['contact_position_ar'] ?? '' }}"
                                                            placeholder="{{ __('Enter Contact Position (Arabic)') }}">
                                                    </div>
                                                </div>

                                                <!-- English Tab -->

                                                <div class="tab-pane fade" id="english" role="tabpanel"
                                                    aria-labelledby="english-tab">
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('Facility Name (English)') }}</label>
                                                        <input type="text" name="facility_name_en"
                                                            class="form-control"
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
                                                        <label
                                                            class="form-label">{{ __('Message Facility (English)') }}</label>
                                                        <textarea name="messages_en" class="form-control summernote" rows="3"
                                                            placeholder="{{ __('Enter Message Facility (English)') }}">{{ $settings['messages_en'] ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('Contact Name (English)') }}</label>
                                                        <input type="text" name="contact_name_en" class="form-control"
                                                            value="{{ $settings['contact_name_en'] ?? '' }}"
                                                            placeholder="{{ __('Enter Contact Name (English)') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            class="form-label">{{ __('Contact Position (English)') }}</label>
                                                        <input type="text" name="contact_position_en"
                                                            class="form-control"
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
                                                    <input type="text" name="report_preparer_name"
                                                        class="form-control"
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

                                            <button type="submit" id="hidden-submit"
                                                class="btn btn-primary ">{{ __('Save Changes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Excureive Summary-->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading10">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                        {{ __('Executive Summary') }}
                                    </button>
                                </h2>
                                <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <!-- Language Tabs -->
                                        <ul class="nav nav-tabs w-100" id="reportGuidelinesTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="english10-tab" data-bs-toggle="tab"
                                                    data-bs-target="#english10" type="button" role="tab"
                                                    aria-controls="english10" aria-selected="true">
                                                    {{ __('English') }}
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="arabic10-tab" data-bs-toggle="tab"
                                                    data-bs-target="#arabic10" type="button" role="tab"
                                                    aria-controls="arabic10" aria-selected="false">
                                                    {{ __('Arabic') }}
                                                </button>
                                            </li>
                                        </ul>
                                        <form method="POST" class="mt-3"
                                            action="{{ route('setting.saveSelfReport') }}">
                                            <input type="hidden" name="section" value="executive_summary">
                                            @csrf
                                            <div class="tab-content" id="reportGuidelinesTabContent">
                                                <div class="tab-pane fade show active" id="english10" role="tabpanel"
                                                    aria-labelledby="english10-tab">
                                                    <div class="mb-3">
                                                        <label for="executive_summary"
                                                            class="form-label">{{ __('Executive Summary') }}</label>
                                                        <textarea class="form-control summernote" id="executive_summary" name="executive_summary_en" rows="4">{{ old('executive_summary_en') ?? ($settings['executive_summary_en'] ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="arabic10" role="tabpanel"
                                                    aria-labelledby="arabic10-tab">
                                                    <div class="mb-3">
                                                        <label for="executive_summary"
                                                            class="form-label">{{ __('Executive Summary') }}</label>

                                                        <textarea class="form-control summernote" id="executive_summary" name="executive_summary_ar" rows="4">{{ old('executive_summary_ar') ?? ($settings['executive_summary_ar'] ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Report Guidelines -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        {{ __('Report Guidelines') }}
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <!-- Language Tabs -->
                                        <ul class="nav nav-tabs w-100" id="reportGuidelinesTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="english2-tab" data-bs-toggle="tab"
                                                    data-bs-target="#english2" type="button" role="tab"
                                                    aria-controls="english2" aria-selected="true">
                                                    {{ __('English') }}
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="arabic2-tab" data-bs-toggle="tab"
                                                    data-bs-target="#arabic2" type="button" role="tab"
                                                    aria-controls="arabic2" aria-selected="false">
                                                    {{ __('Arabic') }}
                                                </button>
                                            </li>
                                        </ul>

                                        <!-- Tab Content -->
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}"
                                            class="institution-profile-form">
                                            @csrf
                                            <input type="hidden" name="section" value="report_guidelines">

                                            <div class="tab-content mt-3" id="reportGuidelinesTabsContent">
                                                <!-- English Tab -->
                                                <div class="tab-pane fade show active" id="english2" role="tabpanel"
                                                    aria-labelledby="english2-tab">
                                                    <div class="mb-3">
                                                        <label for="reportGuidelinesEnglish"
                                                            class="form-label">{{ __('Report Guidelines (English)') }}</label>
                                                        <textarea class="form-control summernote" id="reportGuidelinesEnglish" name="report_guidelines_en" rows="3">{{ old('report_guidelines_en') ?? ($settings['report_guidelines_en'] ?? '') }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- Arabic Tab -->
                                                <div class="tab-pane fade" id="arabic2" role="tabpanel"
                                                    aria-labelledby="arabic2-tab">
                                                    <div class="mb-3">
                                                        <label for="reportGuidelinesArabic"
                                                            class="form-label">{{ __('Report Guidelines (Arabic)') }}</label>
                                                        <textarea class="form-control summernote" id="reportGuidelinesArabic" name="report_guidelines_ar" rows="3">{{ old('report_guidelines_ar') ?? ($settings['report_guidelines_ar'] ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <button type="submit"
                                                class="btn btn-primary">{{ __('Save Changes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistical Data -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        {{ __('Statistical Data') }}
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <ul class="nav nav-tabs w-100" id="reportGuidelinesTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="english3-tab" data-bs-toggle="tab"
                                                    data-bs-target="#english3" type="button" role="tab"
                                                    aria-controls="english3" aria-selected="true">
                                                    {{ __('English') }}
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="arabic3-tab" data-bs-toggle="tab"
                                                    data-bs-target="#arabic3" type="button" role="tab"
                                                    aria-controls="arabic3" aria-selected="false">
                                                    {{ __('Arabic') }}
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content mt-3" id="reportGuidelinesTabsContent">
                                            <form method="POST" action="{{ route('setting.saveSelfReport') }}"
                                                class="statistical-data-form">
                                                @csrf
                                                <input type="hidden" name="section" value="statistical_data">
                                                <div class="tab-pane fade show active" id="english3" role="tabpanel"
                                                    aria-labelledby="english3-tab">
                                                    <div class="mb-3">
                                                        <label for="statisticalData"
                                                            class="form-label">{{ __('Statistical Information') }}</label>
                                                        <textarea class="form-control summernote" id="statisticalData" name="statistical_data_en" rows="4">{{ old('statistical_data_en') ?? ($settings['statistical_data_en'] ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="arabic3" role="tabpanel"
                                                    aria-labelledby="arabic3-tab">
                                                    <div class="mb-3">
                                                        <label for="statisticalDataArabic"
                                                            class="form-label">{{ __('Statistical Information (Arabic)') }}</label>
                                                        <textarea class="form-control summernote" id="statisticalDataArabic" name="statistical_data_ar" rows="4">{{ old('statistical_data_ar') ?? ($settings['statistical_data_ar'] ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Education and Training Body -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        {{ __('Education and Training Body') }}
                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                            @csrf
                                            <input type="hidden" name="section" value="education_training">
                                            <div class="mb-3">
                                                <label for="trainingInfo"
                                                    class="form-label">{{ __('Education and Training Information') }}</label>
                                                <textarea class="form-control summernote" id="trainingInfo" name="education_training" rows="4">{{ old('education_training') ?? ($settings['education_training'] ?? '') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Classification of the Education and Training Body -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        {{ __('Classification of the Education and Training Body') }}
                                    </button>
                                </h2>
                                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                            @csrf
                                            <input type="hidden" name="section" value="classification">
                                            <div class="mb-3">
                                                <label for="classification"
                                                    class="form-label">{{ __('Classification Details') }}</label>
                                                <textarea class="form-control summernote" id="classification" name="classification" rows="4">{{ old('classification') ?? ($settings['classification'] ?? '') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Students -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading6">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                        {{ __('Students') }}
                                    </button>
                                </h2>
                                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                            @csrf
                                            <input type="hidden" name="section" value="students">
                                            <div class="mb-3">
                                                <label for="studentInfo"
                                                    class="form-label">{{ __('Student Information') }}</label>
                                                <textarea class="form-control summernote" id="studentInfo" name="student_info" rows="4">{{ old('student_info') ?? ($settings['student_info'] ?? '') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Classification by Qualification -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading7">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                        {{ __('Student Classification by Qualification') }}
                                    </button>
                                </h2>
                                <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                            @csrf
                                            <input type="hidden" name="section" value="student_classification">
                                            <div class="mb-3">
                                                <label for="qualificationInfo"
                                                    class="form-label">{{ __('Qualification Information') }}</label>
                                                <textarea class="form-control summernote" id="qualificationInfo" name="qualification_info" rows="4">{{ old('qualification_info') ?? ($settings['qualification_info'] ?? '') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Discussion of Statistical Data -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading8">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                        {{ __('Discussion of Statistical Data') }}
                                    </button>
                                </h2>
                                <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                            @csrf
                                            <input type="hidden" name="section" value="statistical_discussion">
                                            <div class="mb-3">
                                                <label for="dataDiscussion"
                                                    class="form-label">{{ __('Data Discussion') }}</label>
                                                <textarea class="form-control summernote" id="dataDiscussion" name="data_discussion" rows="4">{{ old('data_discussion') ?? ($settings['data_discussion'] ?? '') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Key Performance Indicators and Benchmarking -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading9">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                        {{ __('Key Performance Indicators and Benchmarking') }}
                                    </button>
                                </h2>
                                <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                            @csrf
                                            <input type="hidden" name="section" value="kpi_benchmarking">
                                            <div class="mb-3">
                                                <label for="kpiInfo"
                                                    class="form-label">{{ __('KPI Information') }}</label>
                                                <textarea class="form-control summernote" id="kpiInfo" name="kpi_info" rows="4">{{ old('kpi_info') ?? ($settings['kpi_info'] ?? '') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!-- Independent Evaluations -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading11">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                        {{ __('Independent Evaluations (Optional)') }}
                                    </button>
                                </h2>
                                <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                            @csrf
                                            <input type="hidden" name="section" value="independent_evaluations">
                                            <div class="mb-3">
                                                <label for="evaluationInfo"
                                                    class="form-label">{{ __('Evaluation Information') }}</label>
                                                <textarea class="form-control summernote" id="evaluationInfo" name="evaluation_info" rows="4">{{ old('evaluation_info') ?? ($settings['evaluation_info'] ?? '') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Executive Recommendations -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading12">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                        {{ __('Executive Recommendations') }}
                                    </button>
                                </h2>
                                <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                            @csrf
                                            <input type="hidden" name="section" value="executive_recommendations">
                                            <div class="mb-3">
                                                <label for="recommendationInfo"
                                                    class="form-label">{{ __('Recommendation Information') }}</label>
                                                <textarea class="form-control summernote" id="recommendationInfo" name="recommendation_info" rows="4">{{ old('recommendation_info') ?? ($settings['recommendation_info'] ?? '') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Attachments -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading13">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                        {{ __('Attachments') }}
                                    </button>
                                </h2>
                                <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('setting.saveSelfReport') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="section" value="attachments">
                                            <div class="mb-3">
                                                <label for="attachments"
                                                    class="form-label">{{ __('Upload Attachments') }}</label>
                                                <textarea class="form-control summernote" id="attachments" name="attachments" rows="4">{{ old('attachments') ?? ($settings['attachments'] ?? '') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                                        </form>
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

@section('scripts')
    <script>
        // Initialize any JavaScript enhancements here
        document.addEventListener('DOMContentLoaded', function() {
            // Add any necessary JavaScript initialization
        });
    </script>
@endsection
