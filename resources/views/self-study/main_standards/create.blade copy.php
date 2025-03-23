@extends('layouts.admin')
@section('page-title')
    {{ __('Create Standard') }}
@endsection
@section('title')
    {{ __('Create Standard') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('main-standards.index') }}">{{ __('MainStandard') }}</a></li>

    <li class="breadcrumb-item active" aria-current="page">{{ __('Create Standard') }}</li>
@endsection
@section('action-btn')
    <div class="pr-2">

        <a href="{{ route('main-standards.index') }}" class="btn btn-light-secondary me-3"> <i data-feather="x-circle"
                class="me-2"></i>{{ __('Cancel') }}</a>
        <a type="submit" id="submit-all" class="btn btn-primary text-white"> <i data-feather="check-circle"
                class="me-2"></i>{{ __('Save') }}</a>
    </div>
@endsection
@section('filter')
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{ asset('custom/libs/summernote/summernote-bs4.css') }}">
@endpush

@push('script-page')
    <script src="{{ asset('custom/libs/summernote/summernote-bs4.js') }}"></script>
    <script>
        function toggleSubStandardFields() {
            const type = document.getElementById('type').value;
            const mainStandardField = document.getElementById('main-standard-field');

            if (type === 'sub') {
                mainStandardField.classList.remove('d-none');
            } else {
                mainStandardField.classList.add('d-none');
            }
        }

        

        function validateForm(formId) {
            let isValid = true
            $(`#${formId} [required]`).each(function() {
                const field = $(this);
                const value = field.val().trim();

                if (!value) {
                    isValid = false;
                    field.addClass('add-required');
                    field.next('.invalid-feedback').remove();
                    field.after('<div class="invalid-feedback">{{ __('This field is required.') }}</div>');
                } else {
                    field.removeClass('is-invalid');
                    field.next('.invalid-feedback').remove();
                }
            });

            return isValid;
        }

        $(document).ready(function () {
        // Handle form submission
        $('#submit-all').on('click', function (e) {
            e.preventDefault(); // Prevent default form submission

            // Validate the form
            if (validateForm('frmTarget')) {
                var fd = new FormData();
                var other_data = $('#frmTarget').serializeArray();

                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });

                $.ajax({
                    url: "{{ route('main-standards.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: fd,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (data) {
                        if (data.flag === "success") {
                            toastr.success(data.msg, 'Success');
                            setTimeout(() => {
                                window.location.href = "{{ route('main-standards.index') }}";
                            }, 1500);
                        } else {
                            alert(data.msg);
                            // toastr.error(data.msg, 'Error');
                        }
                    },
                    error: function (data) {
                        if (data.responseJSON && data.responseJSON.message) {
                            alert(data.responseJSON.message);
                            // toastr.error(data.responseJSON.message, 'Error');
                        } else {
                            alert('ErrAn unexpected error occurredor');

                            // toastr.error('An unexpected error occurred.', 'Error');
                        }
                    }
                });
            } else {
                toastr.error('{{ __("Please fill all required fields.") }}', 'Error');
            }
        });
    });

    </script>
@endpush

@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            {{ Form::open(['method' => 'post', 'id' => 'frmTarget', 'enctype' => 'multipart/form-data', 'route' => 'main-standards.store']) }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none border border-primary">
                        <div class="card-body">
                            <!-- Select Type: Main Standard or Sub-Standard -->
                            <div class="form-group">
                                {{ Form::label('type', __('Type'), ['class' => 'form-label']) }}
                                {{ Form::select('type', ['main' => __('Main Standard'), 'sub' => __('Sub-Standard')], null, ['class' => 'form-control', 'id' => 'type', 'onchange' => 'toggleSubStandardFields()']) }}
                            </div>

                            <!-- Parent Main Standard (Visible only for Sub-Standards) -->
                            <div id="main-standard-field" class="form-group d-none">
                                {{ Form::label('main_standard_id', __('Parent Main Standard'), ['class' => 'form-label']) }}
                                {{ Form::select('main_standard_id', $mainStandards->pluck('name_ar', 'id'), null, ['class' => 'form-control', 'required']) }}
                            </div>

                            <!-- Sequence -->
                            <div class="form-group">
                                {{ Form::label('sequence', __('Sequence'), ['class' => 'form-label']) }}
                                {{ Form::number('sequence', null, ['class' => 'form-control', 'placeholder' => __('Enter Sequence')]) }}
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
                                        {{ Form::text('name_ar', null, ['class' => 'form-control ', 'placeholder' => __('Enter Name (Arabic)')]) }}
                                    </div>
                                    <div class="form-group ">
                                        {{ Form::label('introduction_ar', __('Introduction (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('introduction_ar', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Introduction (Arabic)'), 'required']) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('description_ar', __('Description (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('description_ar', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Description (Arabic)'), 'required']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('summary_ar', __('Summary (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('summary_ar', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Summary (Arabic)'), 'required']) }}
                                    </div>
                                </div>

                                <!-- English Fields -->
                                <div class="tab-pane fade" id="en-fields" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="form-group  mt-3">
                                        {{ Form::label('name_en', __('Name (English)'), ['class' => 'form-label']) }}
                                        {{ Form::text('name_en', null, ['class' => 'form-control', 'placeholder' => __('Enter Name (English)'), 'required']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('introduction_en', __('Introduction (English)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('introduction_en', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Introduction (English)'), 'required']) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('description_en', __('Description (English)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('description_en', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Description (English)'), 'required']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('summary_en', __('Summary (English)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('summary_en', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Summary (English)'), 'required']) }}
                                    </div>
                                </div>
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
