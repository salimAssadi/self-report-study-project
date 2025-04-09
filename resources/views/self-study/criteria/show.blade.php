@extends('layouts.admin-app')

@section('page-title')
    {{ __('View Criterion') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('criteria.index') }}">{{ __('Criteria') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ $criteria->name }}
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Criterion Header -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3 class="mb-1">{{ $criteria->sequence }}</h3>
                        <div class="d-flex gap-4">
                            <h4 class="text-muted mb-0">{{ $criteria->name }}</h4>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('criteria.edit', $criteria->id) }}" class="btn btn-primary">
                            <i class="ti ti-pencil"></i> {{ __('Edit') }}
                        </a>
                        <a href="{{ route('criteria.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>
                
                <!-- Status Badges -->
                <div class="d-flex gap-3 mb-4">
                    @switch($criteria->fulfillment_status)
                        @case('1')
                            <span class="badge rounded-pill bg-danger">{{ __('Not Fulfilled') }}</span>
                            @break
                        @case('2')
                            <span class="badge rounded-pill bg-warning">{{ __('Partially Fulfilled') }}</span>
                            @break
                        @case('3')
                            <span class="badge rounded-pill bg-info">{{ __('Fulfilled') }}</span>
                            @break
                        @case('4')
                            <span class="badge rounded-pill bg-primary">{{ __('Fulfilled with Excellence') }}</span>
                            @break
                        @case('5')
                            <span class="badge rounded-pill bg-success">{{ __('Fulfilled with Distinction') }}</span>
                            @break
                    @endswitch
                    
                    @if ($criteria->is_met == '1')
                        <span class="badge rounded-pill bg-success">{{ __('Matching') }}</span>
                    @else
                        <span class="badge rounded-pill bg-danger">{{ __('Not Matching') }}</span>
                    @endif
                </div>

                <!-- Standard Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border shadow-none bg-light">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Main Standard') }}</h5>
                                <p class="card-text">{{ $criteria->standard?->parent?->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border shadow-none bg-light">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Sub Standard') }}</h5>
                                <p class="card-text">{{ $criteria->standard->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Standard Managers -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border shadow-none bg-light">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Standard Managers') }}</h5>
                                @if($criteria->standard && $criteria->standard->users->count() > 0)
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($criteria->standard->users as $user)
                                            <div class="badge bg-primary p-2">
                                                <i class="ti ti-user me-1"></i>
                                                {{ $user->full_name }}
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted mb-0">{{ __('No managers assigned to this standard.') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>{{ __('Content (Arabic)') }}</h5>
                        <div class="p-3 bg-light rounded">
                            {!! $criteria->content_ar !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>{{ __('Content (English)') }}</h5>
                        <div class="p-3 bg-light rounded">
                            {!! $criteria->content_en !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Links Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Links') }}</h5>
            </div>
            <div class="card-body">
                @if($criteria->links->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Name (Arabic)') }}</th>
                                    <th>{{ __('Name (English)') }}</th>
                                    <th>{{ __('URL') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($criteria->links as $link)
                                    <tr>
                                        <td>{{ $link->name_ar }}</td>
                                        <td>{{ $link->name_en }}</td>
                                        <td>
                                            <a href="{{ $link->url }}" target="_blank" class="text-primary">
                                                {{ Str::limit($link->url, 50) }}
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info copy-url" data-url="{{ $link->url }}">
                                                <i class="ti ti-copy"></i>
                                            </button>
                                            <a href="{{ $link->url }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="ti ti-external-link"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">{{ __('No links available.') }}</p>
                @endif
            </div>
        </div>

        <!-- Attachments Section -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Attachments') }}</h5>
            </div>
            <div class="card-body">
                @if($criteria->attachments->count() > 0)
                    <div class="row g-3">
                        @foreach($criteria->attachments as $attachment)
                            <div class="col-md-4">
                                <div class="card h-100 border shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h6 class="mb-1">{{ $attachment->name_ar }}</h6>
                                                <small class="text-muted">{{ $attachment->name_en }}</small>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item copy-url" href="#" data-url="{{ asset(Storage::url($attachment->file_path)) }}">
                                                            <i class="ti ti-copy me-2"></i>{{ __('Copy URL') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ asset(Storage::url($attachment->file_path)) }}" target="_blank">
                                                            <i class="ti ti-eye me-2"></i>{{ __('View') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ asset(Storage::url($attachment->file_path)) }}" download>
                                                            <i class="ti ti-download me-2"></i>{{ __('Download') }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="text-center p-3 bg-light rounded">
                                            @php
                                                $extension = pathinfo($attachment->file_path, PATHINFO_EXTENSION);
                                            @endphp
                                            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset(Storage::url($attachment->file_path)) }}" alt="{{ $attachment->name_en }}" class="img-fluid" style="max-height: 150px;">
                                            @else
                                                <i class="ti ti-file-text text-primary" style="font-size: 48px;"></i>
                                                <p class="mb-0 mt-2">{{ strtoupper($extension) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">{{ __('No attachments available.') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-page')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy URL functionality
    document.querySelectorAll('.copy-url').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.dataset.url;
            navigator.clipboard.writeText(url).then(() => {
                // Show success message
                const originalHtml = this.innerHTML;
                this.innerHTML = '<i class="ti ti-check"></i>';
                setTimeout(() => {
                    this.innerHTML = originalHtml;
                }, 2000);
            });
        });
    });
});
</script>
@endpush
