<div class="px-2">
    <h3 class="my-3">1-{{ __('Facility Info') }}</h3>
    <div class="row">
        <h3 class="primarybg p-1">
            {{ __('Facility Vision') }}
        </h3>
        <div class="secondarybg p-1">
            {!! getSettingsValByNameWithLang('vision')!!}
        </div>
    </div>
    <div class="row">
        <h3 class="primarybg p-1">
            {{ __('Facility Goals') }}
        </h3>
        <div class="secondarybg p-1">
            {!! getSettingsValByNameWithLang('goals')!!}
        </div>
    </div>
    <div class="row">
        <h3 class="primarybg p-1">
            {{ __('Facility Message') }}
        </h3>
        <div class="secondarybg p-1">
            {!! getSettingsValByNameWithLang('message')!!}

        </div>
    </div>
</div>