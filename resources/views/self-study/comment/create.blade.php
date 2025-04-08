@extends('layouts.admin-app')

@section('page-title')
    {{ __('Create New Comment') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('comments.all') }}">{{ __('Comments') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('criterion.comments.store', request('criterion_id')) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label" for="criterion_id">{{ __('Select Criterion') }}</label>
                        <select id="criterion_id" name="criterion_id" class="form-select @error('criterion_id') is-invalid @enderror" required>
                            <option value="">{{ __('Select a criterion...') }}</option>
                            @foreach($criteria as $criterion)
                                <option value="{{ $criterion->id }}" {{ old('criterion_id', request('criterion_id')) == $criterion->id ? 'selected' : '' }}>
                                    {{ $criterion->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('criterion_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="content">{{ __('Comment') }}</label>
                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="5" required>{{ old('content') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-send"></i>
                            {{ __('Post Comment') }}
                        </button>
                        <a href="{{ route('comments.all') }}" class="btn btn-secondary">
                            <i class="ti ti-x"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const criterionSelect = document.getElementById('criterion_id');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const criterionId = criterionSelect.value;
            this.action = "{{ route('criterion.comments.store', '') }}/" + criterionId;
            this.submit();
        });
    });
</script>
@endpush
