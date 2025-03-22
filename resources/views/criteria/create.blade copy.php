@extends('layouts.admin')
@section('page-title')
    {{ __('Add Criterion') }}
@endsection
@section('title')
    {{ __('Add Criterion') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('main-standards.index') }}">{{ __('Criteria') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Add Criterion') }}</li>
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

        let linkIndex = 1;

        document.getElementById('add-link').addEventListener('click', function() {
            const tableBody = document.querySelector('#links-table tbody');
            const newRow = document.createElement('tr');
            newRow.classList.add('link-row');
            newRow.innerHTML = `
                        <td>
                            <input type="text" name="links[${linkIndex}][name_ar]" class="form-control" placeholder="{{ __('Link Name (Arabic)') }}">
                        </td>
                        <td>
                            <input type="text" name="links[${linkIndex}][name_en]" class="form-control" placeholder="{{ __('Link Name (English)') }}">
                        </td>
                        <td>
                            <input type="text" name="links[${linkIndex}][url]" class="form-control" placeholder="{{ __('Link URL') }}">
                        </td>
                        <td class="w-10 text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-link"><i class="fa fa-minus"></i></button>
                        </td>
                    `;
            tableBody.appendChild(newRow);
            linkIndex++;
        });

        // Remove link row
        document.querySelector('#links-container').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-link')) {
                e.target.closest('tr').remove();
            }
        });


        let attachmentIndex = 1;

        document.getElementById('add-attachment').addEventListener('click', function() {
            const tableBody = document.querySelector('#attachments-table tbody');
            const newRow = document.createElement('tr');
            newRow.classList.add('attachment-row');
            newRow.innerHTML = `
                                <td>
                                    <input type="text" name="attachments[${attachmentIndex}][name_ar]" class="form-control" placeholder="{{ __('Attachment Name (Arabic)') }}">
                                </td>
                                <td>
                                    <input type="text" name="attachments[${attachmentIndex}][name_en]" class="form-control" placeholder="{{ __('Attachment Name (English)') }}">
                                </td>
                                <td>
                                    <input type="file" name="attachments[${attachmentIndex}][file]" class="form-control">
                                </td>
                                <td class="w-10 text-center">
                                    <button type="button" class="btn btn-sm btn-danger remove-attachment"><i class="fa fa-minus"></i></button>
                                </td>
                            `;
            tableBody.appendChild(newRow);
            attachmentIndex++;
        });

        // Remove attachment row
        document.querySelector('#attachments-container').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-attachment')) {
                e.target.closest('tr').remove();
            }
        });

        // Dynamically populate the Standard dropdown based on the selected Standard Type
        document.getElementById('standard_type').addEventListener('change', function() {
            const standardType = this.value;
            const standardIdDropdown = document.getElementById('standard_id');

            // Clear existing options
            standardIdDropdown.innerHTML = `<option value="">{{ __('Select Standard') }}</option>`;

            if (standardType) {
                $.ajax({
                    url: `{{route('api.standards')}}`,
                    type: 'GET',
                    data: {
                        type: standardType
                    },
                    success: function(data) {
                        // Populate the dropdown with received data
                        data.forEach(standard => {
                            const option = document.createElement('option');
                            option.value = standard.id;
                            option.textContent = standard.name_ar || standard.name_en;
                            standardIdDropdown.appendChild(option);
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching standards:', error);
                    }
                });
            }
        });
        document.getElementById('submit-all').addEventListener('click', function() {
            document.getElementById('hidden-submit').click();
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            {{ Form::open(['method' => 'post', 'route' => 'criteria.store', 'enctype' => 'multipart/form-data']) }}
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none border border-primary">
                        <div class="card-body">
                            <div class="form-group">
                                {{ Form::label('standard_type', __('Standard Type'), ['class' => 'form-label']) }}
                                {{ Form::select(
                                    'standard_type',
                                    [
                                        'App\Models\MainStandard' => __('Main Standard'),
                                        'App\Models\SubStandard' => __('Sub-Standard'),
                                    ],
                                    null,
                                    ['class' => 'form-control', 'id' => 'standard_type', 'required'],
                                ) }}
                            </div>

                            <!-- Standard ID -->
                            <div class="form-group">
                                {{ Form::label('standard_id', __('Standard'), ['class' => 'form-label']) }}
                                <select name="standard_id" id="standard_id" class="form-control" required>
                                    <option value="">{{ __('Select Standard') }}</option>
                                </select>
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
                                <div class="tab-pane fade show active" id="ar-fields" role="tabpanel"
                                    aria-labelledby="ar-tab">
                                    <!-- Name (Arabic) -->
                                    <div class="form-group mt-3">
                                        {{ Form::label('name_ar', __('Name (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::text('name_ar', null, ['class' => 'form-control', 'placeholder' => __('Enter Name (Arabic)'), 'required']) }}
                                    </div>

                                    <!-- Content (Arabic) -->
                                    <div class="form-group">
                                        {{ Form::label('content_ar', __('Content (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('content_ar', null, ['class' => 'form-control summernote', 'rows' => 3, 'placeholder' => __('Enter Content (Arabic)')]) }}
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="en-fields" role="tabpanel" aria-labelledby="en-tab">
                                    <!-- Name (English) -->
                                    <div class="form-group mt-3">
                                        {{ Form::label('name_en', __('Name (English)'), ['class' => 'form-label']) }}
                                        {{ Form::text('name_en', null, ['class' => 'form-control', 'placeholder' => __('Enter Name (English)'), 'required']) }}
                                    </div>

                                    <!-- Content (English) -->
                                    <div class="form-group">
                                        {{ Form::label('content_en', __('Content (English)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('content_en', null, ['class' => 'form-control summernote', 'rows' => 3, 'placeholder' => __('Enter Content (English)')]) }}
                                    </div>

                                </div>
                            </div>




                            <!-- Links -->
                            <div class="form-group">
                                {{ Form::label('links', __('Links'), ['class' => 'form-label']) }}
                                <div id="links-container">
                                    <table class="table table-bordered" id="links-table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Link Name (Arabic)') }}</th>
                                                <th>{{ __('Link Name (English)') }}</th>
                                                <th>{{ __('Link URL') }}</th>
                                                <th class="w-10 text-center">
                                                    <button type="button" id="add-link"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Initial Row -->
                                            <tr class="link-row">
                                                <td>
                                                    {{ Form::text('links[0][name_ar]', null, ['class' => 'form-control', 'placeholder' => __('Link Name (Arabic)')]) }}
                                                </td>
                                                <td>
                                                    {{ Form::text('links[0][name_en]', null, ['class' => 'form-control', 'placeholder' => __('Link Name (English)')]) }}
                                                </td>
                                                <td>
                                                    {{ Form::text('links[0][url]', null, ['class' => 'form-control', 'placeholder' => __('Link URL')]) }}
                                                </td>
                                                <td class="w-10 text-center">
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger remove-link"><i class="fa fa-minus"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <!-- Attachments -->
                            <div class="form-group">
                                {{ Form::label('attachments', __('Attachments'), ['class' => 'form-label']) }}
                                <div id="attachments-container">
                                    <table class="table table-bordered" id="attachments-table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Attachment Name (Arabic)') }}</th>
                                                <th>{{ __('Attachment Name (English)') }}</th>
                                                <th>{{ __('File') }}</th>
                                                <th class="w-10 text-center">
                                                    <button type="button" id="add-attachment"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Initial Row -->
                                            <tr class="attachment-row">
                                                <td>
                                                    {{ Form::text('attachments[0][name_ar]', null, ['class' => 'form-control', 'placeholder' => __('Attachment Name (Arabic)')]) }}
                                                </td>
                                                <td>
                                                    {{ Form::text('attachments[0][name_en]', null, ['class' => 'form-control', 'placeholder' => __('Attachment Name (English)')]) }}
                                                </td>
                                                <td>
                                                    {{ Form::file('attachments[0][file]', ['class' => 'form-control']) }}
                                                </td>
                                                <td class="w-10 text-center">
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger remove-attachment"><i class="fa fa-minus"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- <!-- Submit Button -->
                    <div class="form-group mt-3">
                        {{ Form::submit(__('Create Criterion'), ['class' => 'btn btn-primary']) }}
                    </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}

        </div>
        <!-- [ sample-page ] end -->
    </div>
@endsection
