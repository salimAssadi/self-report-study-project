<div class="px-2">
    <h3 class="my-3">2-{{ __('Statistical Data') }}</h3>
</div>
<div class="row">
    <h3 class=" my-3">
        {{ __('Education and Training Body') }}
    </h3>
    <div class="secondarybg p-1">
        {!! getSettingsValByName('education_training')!!}
    </div>
</div>
<div class="row">
    <h3 class=" my-3">
        {{ __('Classification of the Education and Training Body') }}
    </h3>
    <div class="secondarybg p-1">
        {!! getSettingsValByName('classification')!!}
    </div>
</div>
<div class="row">
    <h3 class=" my-3">
        {{ __('Students') }}
    </h3>
    <div class="secondarybg p-1">
        {!! getSettingsValByName('student_info')!!}
    </div>
</div>
<div class="row">
    <h3 class=" my-3">
        {{ __('Student Classification by Qualification') }}
    </h3>
    <div class="secondarybg p-1">
        {!! getSettingsValByName('qualification_info')!!}
    </div>
</div>
