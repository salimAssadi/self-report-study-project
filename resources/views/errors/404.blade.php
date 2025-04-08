@extends('layouts.admin-auth')

@section('page-title')
    {{ __('Not Found') }}
@endsection

@section('content')
    <div class="auth-wrapper v2">
        <div class="auth-form">
            <div class="text-center">
                <img src="{{ asset('assets/images/404.svg') }}" alt="404" class="img-fluid" style="max-width: 300px;">
                <h1 class="error-title mt-4">{{ __('404') }}</h1>
                <h4 class="text-muted">{{ __('Page Not Found') }}</h4>
                <p class="text-muted">{{ __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.') }}</p>
                <a href="{{ route('home') }}" class="btn btn-secondary mt-4">{{ __('Back to Home') }}</a>
            </div>
        </div>
    </div>
@endsection
