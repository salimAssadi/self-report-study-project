{{ Form::label('standard_id', __('Standard'), ['class' => 'form-label']) }}
<select name="standard_id" id="standard_id" class="form-control" required>
    <option value="">{{ __('Select Standard') }}</option>
    @foreach ($standards as $standard)
        <option value="{{ $standard->id }}">{{ $standard->name_ar }}</option>
    @endforeach
</select>