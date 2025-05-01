@extends('layouts.admin-app')

@section('page-title')
    {{ __('Create User') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __('Create') }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Create User') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Email') }}</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                        value="{{ old('email') }}" >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Password') }}</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('Role') }}</label>
                                    <select name="role" class="form-control hidesearch" required>
                                        <option value="">{{ __('Select a role') }}</option>
                                        @foreach($roles as $id => $name)
                                            <option value="{{ $id }}" {{ old('role') == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
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
                                                                {{ in_array($mainStandard->id, old('standards', [])) ? 'checked' : '' }}>
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
                                                                        {{ in_array($subStandard->id, old('standards', [])) ? 'checked' : '' }}>
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
                            <button type="submit" class="btn btn-primary">{{ __('Create User') }}</button>
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
