<form method="post" action="{{ route('admin.criteria.store') }}">
    @csrf
    <div class="modal-body">
        <div class="row">
            {{-- <div class="form-group col-md-12">
                {{ Form::label('standard_type', __('Standard Type'), ['class' => 'form-label']) }}
                {{ Form::select(
                    'standard_type',
                    [
                        'main' => __('Main Standard'),
                        'sub' => __('Sub-Standard'),
                    ],
                    null,
                    ['class' => 'form-control', 'id' => 'standard_type', 'required'],
                ) }}
            </div> --}}
            <div class="form-group  col-md-12">
                {{ Form::label('standard_id', __('Standard'), ['class' => 'form-label']) }}
                <select name="main_standard_id" id="main_standard_id" class="form-control" required>
                    <option value="">{{ __('Select Standard') }}</option>
                    @foreach ($mainStandards as $mainStandard)
                        <option value="{{ $mainStandard->id }}">{{ $mainStandard->name_ar }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Standard ID -->
            <div class="form-group  col-md-12">
                {{ Form::label('standard_id', __('Standard'), ['class' => 'form-label']) }}
                <select name="sub_standard_id" id="sub_standard_id" class="form-control">
                    <option value="">{{ __('Select Standard') }}</option>
                   
                </select>
            </div>
            <!-- Sequence -->
            <div class="form-group  col-md-6">
                {{ Form::label('sequence', __('Sequence'), ['class' => 'form-label']) }}
                {{ Form::number('sequence', null, ['class' => 'form-control', 'placeholder' => __('Enter Sequence'), 'step' => '0.1']) }}
            </div>
            <!-- Name (Arabic) -->
            <div class="form-group  col-md-12">
                {{ Form::label('name_ar', __('Name (Arabic)'), ['class' => 'form-label']) }}
                {{ Form::textarea('name_ar', null, ['class' => 'form-control', 'rows' => 1, 'placeholder' => __('Enter Name (Arabic)'), 'required']) }}
            </div>
            <div class="form-group  col-md-12">
                {{ Form::label('name_en', __('Name (English)'), ['class' => 'form-label']) }}
                {{ Form::textarea('name_en', null, ['class' => 'form-control', 'rows' => 1, 'placeholder' => __('Enter Name (English)'), 'required']) }}

            </div>

            <div class="form-group col-12 d-flex  justify-content-md-between col-form-label">
                <input type="button" value="{{ __('Cancel') }}" class="btn btn-secondary btn-light"
                    data-bs-dismiss="modal">
                <input type="submit" value="{{ __('Save') }}" class="btn btn-primary ms-2">
            </div>
        </div>
    </div>
</form>

{{-- @push('script-page') --}}
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
</script>
{{-- @endpush --}}
