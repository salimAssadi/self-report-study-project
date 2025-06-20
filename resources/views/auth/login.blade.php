@extends('layouts.admin-auth')
@php
    $settings = settings();
@endphp
@section('tab-title')
    {{ __('Login') }}
@endsection
@push('script-page')
    @if ($settings['google_recaptcha'] == 'on')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
@section('content')
    @php
        $registerPage = getSettingsValByName('register_page');
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <div class="mb-2">
                    <img  src="{{ asset(Storage::url('upload/logo/')) . '/' . getSettingsValByName('company_logo')??'' }}" alt="image"
                        class=" brand-logo" style="max-width: 178px;" />
                </div>
                <h3 class="my-3">
                    {{getSettingsValByName('app_name')}}
                </h3>
            </div>
            <div class="row">

                <div class="d-flex justify-content-center">
                    <div class="auth-header">
                        {{-- <h2 class="text-secondary"><b>{{ __('Hi, Welcome Back') }} </b></h2>
                        <p class="f-16 mt-2">{{ __('Enter your credentials to continue') }}</p> --}}
                    </div>
                </div>
            </div>

            {{ Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form']) }}
            @if (session('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name"
                    placeholder="{{ __('User Name') }}" />
                <label for="user_name">{{ __('User Name') }}</label>
                @error('user_name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="{{ __('Password') }}" />
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                    <span class="invalid-password text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-flex mt-1 justify-content-between">
                <div class="form-check">
                    <input class="form-check-input input-primary" type="checkbox" id="agree"
                        {{ old('remember') ? 'checked' : '' }} />
                    <label class="form-check-label text-muted" for="agree">{{ __('Remember me') }}</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-secondary">{{ __('Forgot Password?') }}</a>
                @endif
            </div>
            @if ($settings['google_recaptcha'] == 'on')
                <div class="form-group">
                    <label for="email" class="form-label"></label>
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                        <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            @endif
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary p-2">{{ __('Login') }}</button>
            </div>
            {{-- @if ($registerPage == 'on')
                <hr />
                <h5 class="d-flex justify-content-center">{{ __("Don't Have An Account?") }} <a class="ms-1 text-secondary"
                        href="{{ route('register') }}">{{ __('Create an account') }}</a>
                </h5>
            @endif --}}
            {{ Form::close() }}
        </div>
    </div>
@endsection
