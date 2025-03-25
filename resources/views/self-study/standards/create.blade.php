@extends('layouts.admin-app')
@php
    $profile = asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
    {{ __('Create Standard') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        {{ __('Create Standard') }}

    </li>
@endsection

@push('script-page')
    <script src="{{ asset('assets/js/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        function toggleSubStandardFields() {
            const type = document.getElementById('type').value;
            const mainStandardField = document.querySelectorAll('.main-standard-field');
            const subStandardField = document.querySelector('#sub-standard-field');
            if (type === 'sub') {
                subStandardField.classList.remove('d-none');
                mainStandardField.forEach(field => field.classList.add('d-none'));
            } else {
                subStandardField.classList.add('d-none');
                mainStandardField.forEach(field => field.classList.remove('d-none'));
            }
        }

        document.getElementById('submit-all').addEventListener('click', function() {
            document.getElementById('hidden-submit').click();
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            {{ Form::open(['method' => 'post', 'id' => 'frmTarget', 'enctype' => 'multipart/form-data', 'route' => 'admin.standards.store']) }}
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none border border-primary">
                        <div class="card-header">
                            <div class="row align-items-center g-2">
                                <div class="col">
                                    <h5>
                                        {{ __('Create Standard') }}
                                    </h5>
                                </div>
                                <div class="col-auto">

                                    <a href="{{ route('admin.standards.index') }}" class="btn btn-light-secondary me-3"> <i
                                            data-feather="x-circle" class="me-2"></i>{{ __('Cancel') }}</a>
                                    <a type="submit" id="submit-all" class="btn btn-primary text-white"> <i
                                            data-feather="check-circle" class="me-2"></i>{{ __('Save') }}</a>
                                </div>

                            </div>
                        </div>
                        <div class="card-body row">
                            <!-- Select Type: Main Standard or Sub-Standard -->

                            <div class="form-group col-6">
                                {{ Form::label('type', __('Type'), ['class' => 'form-label']) }}
                                {{ Form::select('type', ['main' => __('Main Standard'), 'sub' => __('Sub-Standard')], old('type'), ['class' => 'form-control hidesearch', 'id' => 'type', 'onchange' => 'toggleSubStandardFields()']) }}
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                {{ Form::label('completion_status', __('Completion Status'), ['class' => 'form-label']) }}
                                {{ Form::select('completion_status', [
                                    'incomplete' => __('Incomplete'),
                                    'partially_completed' => __('Partially Completed'),
                                    'completed' => __('Completed')
                                ], old('completion_status', 'incomplete'), ['class' => 'form-control hidesearch']) }}
                                @error('completion_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Parent Main Standard (Visible only for Sub-Standards) -->
                            <div id="sub-standard-field" class="form-group {{ old('type') === 'sub' ? '' : 'd-none' }}">
                                {{ Form::label('parent_id', __('Parent Main Standard'), ['class' => 'form-label']) }}
                                {{ Form::select('parent_id', $mainStandards, old('parent_id'), ['class' => 'form-control showsearch']) }}
                                @error('parent_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Sequence -->
                            <div class="form-group">
                                {{ Form::label('sequence', __('Sequence'), ['class' => 'form-label']) }}
                                {{ Form::text('sequence', old('sequence'), ['class' => 'form-control', 'placeholder' => __('Enter Sequence')]) }}
                                @error('sequence')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tabbed Interface for AR and EN Fields -->
                            <ul class="nav nav-tabs nav-fill w-25" id="languageTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="ar-tab" data-bs-toggle="tab"
                                        data-bs-target="#ar-fields" type="button" role="tab" aria-controls="ar-fields"
                                        aria-selected="true">{{ __('Arabic') }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-fields"
                                        type="button" role="tab" aria-controls="en-fields"
                                        aria-selected="false">{{ __('English') }}</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="languageTabsContent">
                                <!-- Arabic Fields -->
                                <div class="tab-pane fade show active" id="ar-fields" role="tabpanel"
                                    aria-labelledby="ar-tab">
                                    <div class="form-group mt-3">
                                        {{ Form::label('name_ar', __('Name (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::text('name_ar', old('name_ar'), ['class' => 'form-control', 'placeholder' => __('Enter Name (Arabic)')]) }}
                                        @error('name_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group main-standard-field">
                                        {{ Form::label('introduction_ar', __('Introduction (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('introduction_ar', old('introduction_ar'), ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Introduction (Arabic)')]) }}
                                        @error('introduction_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('description_ar', __('Description (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('description_ar', old('description_ar'), ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Description (Arabic)')]) }}
                                        @error('description_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group main-standard-field">
                                        {{ Form::label('summary_ar', __('Summary (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('summary_ar', old('summary_ar'), ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Summary (Arabic)')]) }}
                                        @error('summary_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- English Fields -->
                                <div class="tab-pane fade" id="en-fields" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="form-group mt-3">
                                        {{ Form::label('name_en', __('Name (English)'), ['class' => 'form-label']) }}
                                        {{ Form::text('name_en', old('name_en'), ['class' => 'form-control', 'placeholder' => __('Enter Name (English)')]) }}
                                        @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group main-standard-field">
                                        {{ Form::label('introduction_en', __('Introduction (English)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('introduction_en', old('introduction_en'), ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Introduction (English)')]) }}
                                        @error('introduction_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('description_en', __('Description (English)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('description_en', old('description_en'), ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Description (English)')]) }}
                                        @error('description_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group main-standard-field">
                                        {{ Form::label('summary_en', __('Summary (English)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('summary_en', old('summary_en'), ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Summary (English)')]) }}
                                        @error('summary_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>

                    <div class="form-group mt-3">
                        {{ Form::submit(__('Create'), ['class' => 'btn btn-primary', 'id' => 'hidden-submit', 'style' => 'display:none;']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}

    </div>
    <!-- [ sample-page ] end -->
    </div>
@endsection
