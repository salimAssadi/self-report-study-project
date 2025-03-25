<form method="post" action="{{ route('admin.criteria.store') }}">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
                {{ Form::label('main_standard_id', __('Parent Standard'), ['class' => 'form-label']) }}
                <select name="main_standard_id" id="main_standard_id" class="form-control " required>
                    @forelse  ($mainStandards as $mainStandard)
                        <option value="">{{ __('Select Parent Standard') }}</option>
                        <option value="{{ $mainStandard->id }}">{{ $mainStandard->sequence .'-'. $mainStandard->name_ar  }}</option>
                    @empty
                        <option value="">{{ __('Not Found') }}</option>
                    @endforelse

                </select>
            </div>

            <!-- Sub-Standard Dropdown -->
            <div class="form-group col-md-12">
                {{ Form::label('sub_standard_id', __('Sub-Standard'), ['class' => 'form-label']) }}
                <select name="sub_standard_id" id="sub_standard_id" class="form-control ">
                    <option value="">{{ __('Select Sub-Standard') }}</option>
                </select>
            </div>

            <!-- Sequence -->
            <div class="form-group  col-md-12">
                {{ Form::label('sequence', __('Sequence'), ['class' => 'form-label']) }}
                {{ Form::text('sequence', null, ['class' => 'form-control', 'placeholder' => __('Enter Sequence')]) }}
            </div>

            <!-- Name (Arabic) -->
            <div class="form-group  col-md-12">
                {{ Form::label('name_ar', __('Name (Arabic)'), ['class' => 'form-label']) }}
                {{ Form::textarea('name_ar', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('Enter Name (Arabic)'), 'required']) }}
            </div>
            <div class="form-group  col-md-12">
                {{ Form::label('name_en', __('Name (English)'), ['class' => 'form-label']) }}
                {{ Form::textarea('name_en', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('Enter Name (English)'), 'required']) }}

            </div>

            <div class="form-group col-12 d-flex  justify-content-md-between col-form-label">
                <input type="button" value="{{ __('Cancel') }}" class="btn btn-secondary btn-light"
                    data-bs-dismiss="modal">
                <input type="submit" value="{{ __('Save') }}" class="btn btn-primary ms-2">
            </div>
        </div>
    </div>
</form>
{{-- @push('script-pages') --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const mainStandardDropdown = $('#main_standard_id');
        const subStandardDropdown = $('#sub_standard_id');

        // Fetch sub-standards for the selected main standard
        mainStandardDropdown.on('change', function() {
            const mainStandardId = mainStandardDropdown.val();

            // Clear existing options in the sub-standard dropdown
            subStandardDropdown.empty();
            subStandardDropdown.append('<option value="">{{ __('Select Sub-Standard') }}</option>');

            if (mainStandardId) {
                $.ajax({
                    url: "{{ route('admin.api.standards.children') }}", // Combine route() with dynamic ID
                    method: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        parent_id: mainStandardId
                    },
                    success: function(data) {
                        if (data.length === 0) {
                            // If no sub-standards are found, show a placeholder option
                            subStandardDropdown.append(
                                '<option value="" disabled>{{ __('No Sub-Standards Available') }}</option>'
                                );
                        } else {
                            // Populate the dropdown with sub-standards
                            data.forEach(function(subStandard) {
                                const option = $('<option>', {
                                    value: subStandard.id,
                                    text: subStandard.sequence + '-' + subStandard.name_ar,
                                });
                                subStandardDropdown.append(option);
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching sub-standards:', error);
                        // Show an error message in the dropdown if the request fails
                        subStandardDropdown.append(
                            '<option value="" disabled>{{ __('Error Loading Sub-Standards') }}</option>'
                            );
                    },
                });
            }
        });
    });
</script>
{{-- @endpush --}}
