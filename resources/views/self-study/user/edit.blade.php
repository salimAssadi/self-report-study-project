@extends('layouts.admin-app')

@section('page-title')
    {{ __('Edit User') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __('Edit') }} - {{ $user->name }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Edit User') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->full_name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('User Name') }}</label>
                                    <input type="text" name="user_name" class="form-control @error('user_name') is-invalid @enderror"
                                        value="{{ old('user_name', $user->user_name) }}" required>
                                    @error('user_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Email') }}</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Password') }}</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                    <small class="form-text text-muted">{{ __('Leave empty to keep current password') }}</small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Role') }}</label>
                                    <select name="role" class="form-control  @error('role') is-invalid @enderror">
                                        <option value="">{{ __('Select a role') }}</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->roles->first() && $user->roles->first()->id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Status') }}</label>
                                    <select name="is_active" class="form-control @error('user_name') is-invalid @enderror" required>
                                        <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>{{ __('Enable') }}</option>
                                        <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>{{ __('Disable') }}</option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Standards to Manage') }}</label>
                                    <div class="row">
                                        @foreach($standards as $mainStandard)
                                            <div class="col-md-6 mb-3">
                                                <div class="card border">
                                                    <div class="card-header bg-light">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input main-standard"
                                                                id="main_{{ $mainStandard->id }}"
                                                                name="standards[]"
                                                                value="{{ $mainStandard->id }}"
                                                                {{ in_array($mainStandard->id, $userStandards) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="main_{{ $mainStandard->id }}">
                                                                {{ $mainStandard->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @if($mainStandard->children->count() > 0)
                                                        <div class="card-body">
                                                            @foreach($mainStandard->children as $subStandard)
                                                                <div class="form-check mb-2">
                                                                    <input type="checkbox" class="form-check-input sub-standard"
                                                                        id="sub_{{ $subStandard->id }}"
                                                                        name="standards[]"
                                                                        value="{{ $subStandard->id }}"
                                                                        data-parent="{{ $mainStandard->id }}"
                                                                        {{ in_array($subStandard->id, $userStandards) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="sub_{{ $subStandard->id }}">
                                                                        {{ $subStandard->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('standards')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Update User') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle main standard checkbox changes
    document.querySelectorAll('.main-standard').forEach(mainCheckbox => {
        mainCheckbox.addEventListener('change', function() {
            const mainId = this.id.replace('main_', '');
            const subCheckboxes = document.querySelectorAll(`.sub-standard[data-parent="${mainId}"]`);
            subCheckboxes.forEach(subCheckbox => {
                subCheckbox.checked = this.checked;
            });
        });
    });

    // Handle sub standard checkbox changes
    document.querySelectorAll('.sub-standard').forEach(subCheckbox => {
        subCheckbox.addEventListener('change', function() {
            const parentId = this.dataset.parent;
            const mainCheckbox = document.getElementById(`main_${parentId}`);
            const siblingCheckboxes = document.querySelectorAll(`.sub-standard[data-parent="${parentId}"]`);
            const allChecked = Array.from(siblingCheckboxes).every(checkbox => checkbox.checked);
            mainCheckbox.checked = allChecked;
        });
    });
});
</script>
@endpush