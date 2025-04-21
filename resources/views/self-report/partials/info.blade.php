<div>
    <h3 class="my-2">{{ __('The institution\'s self-study report') }}</h3>
    <table class="table table-bordered info"  cellpadding="10"  >
        <tr>
            <td style="width: 30%;">{{ __('Organization Name') }}</td>
            <td>{{ getSettingsValByNameWithLang('facility_name')?? null }}</td>
        </tr>
        <tr>
            <td>{{ __('Report Preparation Date') }}</td>
            <td>{{ getSettingsValByName('report_date')?? null }}</td>
        </tr>
        <tr>
            <td colspan="2">{{ __('Contact Information') }}</td>
        </tr>
        <tr>
            <td>{{ __('Name') }}</td>
            <td>{{ getSettingsValByNameWithLang('contact_name')?? null }}</td>
        </tr>
        <tr>
            <td>{{ __('Position') }}</td>
            <td>{{ getSettingsValByNameWithLang('contact_position')?? null }}</td>
        </tr>
        <tr>
            <td>{{ __('Email') }}</td>
            <td>{{ getSettingsValByName('contact_email')?? null }}</td>
        </tr>
        <tr>
            <td>{{ __('Phone, Mobile') }}</td>
            <td>{{ getSettingsValByName('contact_phone')?? null }}</td>
        </tr>
    </table>
</div>