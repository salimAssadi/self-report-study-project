@extends('layouts.admin-app')
@section('page-title')
    {{ __('Edit Criterion') }}
@endsection
@section('title')
    {{ __('Edit Criterion') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.criteria.index') }}">{{ __('Criteria') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Criterion') }}</li>
@endsection

@push('script-page')
<script src="{{ asset('assets/js/plugins/tinymce/tinymce.min.js') }}"></script>
<script>

document.getElementById('main_standard_id').addEventListener('change', function() {
        const main_standard_id = this.value;
        const standardIdDropdown = document.getElementById('sub_standard_id');

        // Clear existing options
        standardIdDropdown.innerHTML = `<option value="">{{ __('Select Standard') }}</option>`;

        if (main_standard_id) {
            $.ajax({
                url: `{{ route('admin.api.standards') }}`, // API endpoint
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    main_standard_id: main_standard_id // Pass the selected type
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
      
        document.getElementById('submit-all').addEventListener('click', function() {
            document.getElementById('hidden-submit').click();
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            {{ Form::open(['method' => 'PUT', 'route' => ['admin.criteria.update', $criteria], 'enctype' => 'multipart/form-data']) }}
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none border border-primary">
                        <div class="card-header">
                            <div class="row align-items-center g-2">
                                <div class="col">
                                    <h5>
                                        {{ __('Edit Criterion') }}
                                    </h5>
                                </div>
                                <div class="col-auto">

                                    <a href="{{ route('admin.criteria.index') }}" class="btn btn-light-secondary me-3"> <i data-feather="x-circle"
                                            class="me-2"></i>{{ __('Cancel') }}</a>
                                    <a type="submit" id="submit-all" class="btn btn-primary text-white"> <i data-feather="check-circle"
                                            class="me-2"></i>{{ __('Save') }}</a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                           
                            {{-- <div class="form-group">
                                {{ Form::label('standard_type', __('Standard Type'), ['class' => 'form-label']) }}
                                {{ Form::select(
                                    'standard_type',
                                    [
                                        'main' => __('Main Standard'),
                                        'sub' => __('Sub-Standard'),
                                    ],
                                    $criteria->standard_type,
                                    ['class' => 'form-control', 'id' => 'standard_type'],
                                ) }}
                            </div> --}}

                            <!-- Standard ID -->
                            {{-- <div class="form-group">
                                {{ Form::label('standard_id', __('Standard'), ['class' => 'form-label']) }}
                                <select name="standard_id" id="standard_id" class="form-control" required>
                                    <option value="">{{ __('Select Standard') }}</option>
                                    @foreach ($mainStandards as $standard)
                                        <option value="{{ $standard->id }}" @selected($standard->id == $criteria->standard_id)>
                                            {{ $standard->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="form-group  col-md-12">
                                {{ Form::label('standard_id', __('Main Standard'), ['class' => 'form-label']) }}
                                <select name="main_standard_id" id="main_standard_id" class="form-control" required>
                                    <option value="">{{ __('Select Standard') }}</option>
                                    @foreach ($Standards as $standard)
                                        <option value="{{ $standard->id }}" @selected($standard->id == $criteria->standard_id)>{{ $standard->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <!-- Standard ID -->
                            <div class="form-group  col-md-12">
                                {{ Form::label('standard_id', __('sub Standard'), ['class' => 'form-label']) }}
                                <select name="sub_standard_id" id="sub_standard_id" class="form-control">
                                    <option value="">{{ __('Select Standard') }}</option>
                                    @foreach ($Standards as $standard)
                                        <option value="{{ $standard->id }}" @selected($standard->id == $criteria->standard_id)>{{ $standard->name_ar }}</option>
                                    @endforeach
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
                                        {{ Form::text('name_ar', $criteria->name_ar, ['class' => 'form-control', 'placeholder' => __('Enter Name (Arabic)')]) }}
                                    </div>

                                    <!-- Content (Arabic) -->
                                    <div class="form-group">
                                        {{ Form::label('content_ar', __('Content (Arabic)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('content_ar', $criteria->content_ar, ['class' => 'form-control summernote', 'rows' => 3, 'placeholder' => __('Enter Content (Arabic)')]) }}
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="en-fields" role="tabpanel" aria-labelledby="en-tab">
                                    <!-- Name (English) -->
                                    <div class="form-group mt-3">
                                        {{ Form::label('name_en', __('Name (English)'), ['class' => 'form-label']) }}
                                        {{ Form::text('name_en', $criteria->name_en, ['class' => 'form-control', 'placeholder' => __('Enter Name (English)')]) }}
                                    </div>

                                    <!-- Content (English) -->
                                    <div class="form-group">
                                        {{ Form::label('content_en', __('Content (English)'), ['class' => 'form-label']) }}
                                        {{ Form::textarea('content_en', $criteria->content_en, ['class' => 'form-control summernote', 'rows' => 3, 'placeholder' => __('Enter Content (English)')]) }}
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
                                                    <button type="button" id="add-link" class="btn btn-sm btn-primary"><i
                                                            class="fa fa-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($criteria->links as $link)
                                                <tr class="link-row">
                                                    <td>
                                                        <input type="hidden" name="links[{{ $loop->index }}][id]"
                                                            value="{{ $link->id }}">
                                                        <input type="text" name="links[{{ $loop->index }}][name_ar]"
                                                            class="form-control"
                                                            placeholder="{{ __('Link Name (Arabic)') }}"
                                                            value="{{ $link->name_ar }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="links[{{ $loop->index }}][name_en]"
                                                            class="form-control"
                                                            placeholder="{{ __('Link Name (English)') }}"
                                                            value="{{ $link->name_en }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="links[{{ $loop->index }}][url]"
                                                            class="form-control" placeholder="{{ __('Link URL') }}"
                                                            value="{{ $link->url }}">
                                                    </td>
                                                    <td class="w-10 text-center">
                                                        <button type="button" class="btn btn-sm btn-danger remove-link"><i
                                                                class="fa fa-minus"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach

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
                                            @if ($criteria->attachments)
                                                @foreach ($criteria->attachments as $index => $attachment)
                                                    <tr class="attachment-row">
                                                        <td>
                                                            {{ Form::text("attachments[$index][name_ar]", $attachment->name_ar, ['class' => 'form-control', 'placeholder' => __('Attachment Name (Arabic)')]) }}
                                                        </td>
                                                        <td>
                                                            {{ Form::text("attachments[$index][name_en]", $attachment->name_en, ['class' => 'form-control', 'placeholder' => __('Attachment Name (English)')]) }}
                                                        </td>
                                                        <td>
                                                            {{ Form::file("attachments[$index][file]", ['class' => 'form-control']) }}
                                                        </td>
                                                        <td class="w-10 text-center">
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger remove-attachment">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>
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
