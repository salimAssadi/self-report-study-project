@extends('layouts.admin-auth')

@section('page-title')
    {{ __('Forbidden') }}
@endsection

@section('content')
    <div class="auth-wrapper v2">
        <div class="auth-form">
            <div class="text-center">
                <img src="{{ asset('assets/images/403.svg') }}" alt="403" class="img-fluid" style="max-width: 300px;">
                <h1 class="error-title mt-4">{{ __('403') }}</h1>
                <h4 class="text-muted">{{ __('Access Denied') }}</h4>
                <p class="text-muted">{{ __($exception->getMessage() ?: 'You do not have permission to access this page.') }}</p>
                <a href="{{ route('home') }}" class="btn btn-secondary mt-4">{{ __('Back to Home') }}</a>
            </div>
        </div>
    </div>
@endsection
