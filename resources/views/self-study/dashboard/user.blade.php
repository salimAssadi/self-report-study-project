@extends('layouts.admin-app')

@section('page-title')
    {{ __('Dashboard') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-center text-center">
                        <div class="col-xl-12 col-md-12 col-12">
                            <h4 class="mb-1">{{ __('Welcome') }}, {{ $user->full_name }}!</h4>
                            <p class="mb-4">{{ __('Here\'s what you can do:') }}</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        @can('standards manage')
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-primary">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4">{{ __('Standards') }}</h6>
                                        <p class="text-muted text-sm">{{ __('View and manage standards') }}</p>
                                        <a href="{{ route('standards.index') }}" class="btn btn-primary btn-sm">{{ __('View Standards') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endcan

                        @can('criteria manage')
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-info">
                                            <i class="fas fa-tasks"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4">{{ __('Criteria') }}</h6>
                                        <p class="text-muted text-sm">{{ __('View and manage criteria') }}</p>
                                        <a href="{{ route('criteria.index') }}" class="btn btn-info btn-sm">{{ __('View Criteria') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endcan

                        @can('comments manage')
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-warning">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4">{{ __('Comments') }}</h6>
                                        <p class="text-muted text-sm">{{ __('View and manage comments') }}</p>
                                        <a href="{{ route('comments.all') }}" class="btn btn-warning btn-sm">{{ __('View Comments') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
