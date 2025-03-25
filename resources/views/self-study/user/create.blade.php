{{ Form::open(['route' => 'admin.users.store', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">


        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter email'), 'required' => 'required']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('phone_number', __('Phone Number'), ['class' => 'form-label']) }}
            {{ Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => __('Enter phone number')]) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('role', __('Assign Role'), ['class' => 'form-label']) }}
            {!! Form::select('role', $userRoles, null, [
                'class' => 'form-control  hidesearch',
                'id' => 'role',
                'required' => 'required',
            ]) !!}
        </div>
        <div class="col-md-6 form-group mt-auto d-flex">
            <div class="form-check ">
                <input type="checkbox" name="password_switch" class="form-check-input input-primary pointer"
                    value="on" id="password_switch">
                <label class="form-check-label" for="password_switch"></label>
            </div>
            <label class="form-label" for="password_switch">{{ __('Login is enable') }}</label>
        </div>


        <div class="col-md-6 ps_div d-none">
            <div class="form-group">
                {{-- {{ Form::label('password', __('Password'), ['class' => 'col-form-label']) }} --}}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Password')]) }}
                @error('password')
                    <small class="invalid-password" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>


        <div class="col-md-12 form-group mt-auto d-flex">
            <div class="form-check">
                <input type="checkbox" name="standard_switch" class="form-check-input input-primary" value="on"
                    id="standard_switch">
                <label class="form-check-label" for="standard_switch"></label>
            </div>
            <label class="form-label" for="standard_switch">{{ __('Show Standard List') }}</label>
        </div>

        <!-- Standards with Checkboxes (Hidden by Default) -->
        <div id="standards-section" class="standards-section col-md-12 mt-3 border p-10 rounded-3"
            style="opacity: 0; max-height: 0; overflow: hidden; transition: all 0.5s ease;">
            <div class="d-flex justify-content-between mb-2">
                <h5 clas s="p-2 fs">{{ __('Select Standards to Manage') }}</h5>
                <div class="col-auto">
                    <input class="form-check-input" type="checkbox" name="standards[]" value="all" id="selectall">
                    <label class="form-check-label" for="standard-all">
                        {{ __('Select All') }}
                    </label>
                </div>
            </div>
            <hr>
            <div class="row fst-italic">
                @foreach ($standards as $standard)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input standard-checkbox" type="checkbox" name="standards[]"
                                value="{{ $standard->id }}" id="standard-{{ $standard->id }}">
                            <label class="form-check-label" for="standard-{{ $standard->id }}">
                                {{ $standard->sequence . ' - ' . $standard->name_ar }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    {{ Form::submit(__('Create'), ['class' => 'btn btn-secondary ml-10']) }}
</div>
{{ Form::close() }}

<script>
    $(document).on('change', '#standard_switch', function() {
        const section = $('#standards-section');

        if ($(this).is(':checked')) {
            // Show the section smoothly
            section.css({
                'opacity': 0,
                'max-height': '0',
                'overflow': 'hidden'
            }).animate({
                    opacity: 1,
                    maxHeight: section.get(0).scrollHeight
                },
                500,
                function() {
                    section.css({
                        'overflow': 'visible'
                    });
                }
            );
        } else {
            // Hide the section smoothly
            section.css({
                'overflow': 'hidden'
            }).animate({
                    opacity: 0,
                    maxHeight: 0
                },
                500,
                function() {
                    section.find('input[type="checkbox"]').prop('checked', false); // Uncheck all checkboxes
                }
            );
        }
    });

    $(document).on('change', '#selectall', function() {
        if ($(this).is(':checked')) {
            $('.standard-checkbox').prop('checked', true);
        } else {
            $('.standard-checkbox').prop('checked', false);
        }
    })
</script>
