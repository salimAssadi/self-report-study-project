@extends('layouts.admin-auth')

@section('page-title')
    {{ __('Server Error') }}
@endsection

@section('content')
    <div class="auth-wrapper v2">
        <div class="auth-form">
            <div class="text-center">
                <img src="{{ asset('assets/images/500.svg') }}" alt="500" class="img-fluid" style="max-width: 300px;">
                <h1 class="error-title mt-4">{{ __('500') }}</h1>
                <h4 class="text-muted">{{ __('Server Error') }}</h4>
                <p class="text-muted">{{ __('Something went wrong on our servers. We are working to fix this issue. Please try again later.') }}</p>
                <a href="{{ route('home') }}" class="btn btn-secondary mt-4">{{ __('Back to Home') }}</a>
            </div>
        </div>
    </div>
@endsection
