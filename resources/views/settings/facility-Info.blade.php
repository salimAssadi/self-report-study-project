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
                    <div class="card-header">{{ __('Report Sections') }}</div>

                    <div class="card-body">
                        <div class="accordion" id="selfReportAccordion">
                            <!-- Report Introduction -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        {{ __('Report Introduction') }}
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <!-- Language Tabs -->
                                        <ul class="nav nav-tabs w-25" id="introductionTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="arabic-tab" data-bs-toggle="tab"
                                                    data-bs-target="#arabic" type="button" role="tab"
                                                    aria-controls="arabic" aria-selected="true">{{ __('Arabic') }}</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="english-tab" data-bs-toggle="tab"
                                                    data-bs-target="#english" type="button" role="tab"
                                                    aria-controls="english" aria-selected="false">{{ __('English') }}</button>
                                            </li>
                                        </ul>

                                        <form action="{{ route('setting.saveSelfReport') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="section" value="report_introduction">

                                            <div class="tab-content mt-3" id="introductionTabsContent">
                                                <!-- Arabic Tab -->
                                                <div class="tab-pane fade show active" id="arabic" role="tabpanel"
                                                    aria-labelledby="arabic-tab">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Report Introduction (Arabic)') }}</label>
                                                        <textarea name="introduction_ar" class="form-control summernote" rows="3"
                                                            placeholder="{{ __('Enter Report Introduction in Arabic') }}">{{ $settings['introduction_ar'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- English Tab -->
                                                <div class="tab-pane fade" id="english" role="tabpanel"
                                                    aria-labelledby="english-tab">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Report Introduction (English)') }}</label>
                                                        <textarea name="introduction_en" class="form-control summernote" rows="3"
                                                            placeholder="{{ __('Enter Report Introduction in English') }}">{{ $settings['introduction_en'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-3">{{ __('Save Changes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Report Conclusion -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        {{ __('Report Conclusion') }}
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                    data-bs-parent="#selfReportAccordion">
                                    <div class="accordion-body">
                                        <!-- Language Tabs -->
                                        <ul class="nav nav-tabs w-25" id="conclusionTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="arabic2-tab" data-bs-toggle="tab"
                                                    data-bs-target="#arabic2" type="button" role="tab"
                                                    aria-controls="arabic2" aria-selected="true">{{ __('Arabic') }}</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="english2-tab" data-bs-toggle="tab"
                                                    data-bs-target="#english2" type="button" role="tab"
                                                    aria-controls="english2" aria-selected="false">{{ __('English') }}</button>
                                            </li>
                                        </ul>

                                        <form action="{{ route('setting.saveSelfReport') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="section" value="report_conclusion">

                                            <div class="tab-content mt-3" id="conclusionTabsContent">
                                                <!-- Arabic Tab -->
                                                <div class="tab-pane fade show active" id="arabic2" role="tabpanel"
                                                    aria-labelledby="arabic2-tab">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Report Conclusion (Arabic)') }}</label>
                                                        <textarea name="conclusion_ar" class="form-control summernote" rows="3"
                                                            placeholder="{{ __('Enter Report Conclusion in Arabic') }}">{{ $settings['conclusion_ar'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- English Tab -->
                                                <div class="tab-pane fade" id="english2" role="tabpanel"
                                                    aria-labelledby="english2-tab">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Report Conclusion (English)') }}</label>
                                                        <textarea name="conclusion_en" class="form-control summernote" rows="3"
                                                            placeholder="{{ __('Enter Report Conclusion in English') }}">{{ $settings['conclusion_en'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-3">{{ __('Save Changes') }}</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Add any necessary JavaScript initialization
        });
    </script>
@endsection
