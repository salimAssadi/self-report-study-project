@extends('layouts.admin-app')

@section('page-title')
    {{ __('All Comments') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __('Comments') }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">{{ __('All Comments') }}</h5>
                            <small class="text-muted">{{ __('Manage all comments across criteria') }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($comments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover basic-datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Criterion') }}</th>
                                        <th>{{ __('Comment') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Attachments') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>
                                                <a href="{{ route('criterion.comments.index', $comment->commentable->id) }}" 
                                                   class="text-primary fw-bold">
                                                    {{ $comment?->commentable?->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="comment-content">
                                                    <div class="view-mode">
                                                        <p class="mb-0 text-wrap" style="max-width: 300px;">
                                                            {{ Str::limit($comment->content, 100) }}
                                                        </p>
                                                    </div>
                                                    <div class="edit-mode d-none">
                                                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="input-group">
                                                                <textarea class="form-control" name="content" rows="2" required>{{ $comment->content }}</textarea>
                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                    <i class="ti ti-check"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-secondary cancel-edit">
                                                                    <i class="ti ti-x"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2">
                                                        <span class="avatar-text rounded-circle bg-primary">
                                                            {{ strtoupper(substr($comment->user->full_name ?? '', 0, 1)) }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $comment->user->full_name }}</h6>
                                                        <small class="text-muted">{{ $comment->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span>{{ $comment->created_at->format('Y-m-d') }}</span>
                                                    <small class="text-muted">{{ $comment->created_at->format('H:i') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($comment->attachments->count() > 0)
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" 
                                                                type="button" data-bs-toggle="dropdown">
                                                            <i class="ti ti-paperclip me-1"></i>
                                                            {{ $comment->attachments->count() }}
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @foreach($comment->attachments as $attachment)
                                                                <li>
                                                                    <a class="dropdown-item" 
                                                                       href="{{ route('comments.attachment.download', $attachment->id) }}">
                                                                        <i class="ti ti-download me-1"></i>
                                                                        {{ $attachment->original_filename }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @if(auth()->id() == $comment->user_id)
                                                        <button class="btn btn-sm btn-link edit-comment p-0" 
                                                                data-comment-id="{{ $comment->id }}">
                                                            <i class="ti ti-edit"></i>
                                                        </button>
                                                        <form action="{{ route('comments.destroy', $comment->id) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0"
                                                                    onclick="return confirm('{{ __('Are you sure?') }}')">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a href="{{ route('criterion.comments.index', $comment->commentable->id) }}" 
                                                       class="btn btn-sm btn-link p-0" title="{{ __('View All Comments') }}">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $comments->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <img src="{{ asset('assets/images/empty.svg') }}" class="mb-3" style="max-width: 200px;">
                            <h5>{{ __('No Comments Yet') }}</h5>
                            <p class="text-muted">{{ __('There are no comments to display.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit comment
    document.querySelectorAll('.edit-comment').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const viewMode = row.querySelector('.view-mode');
            const editMode = row.querySelector('.edit-mode');
            
            viewMode.classList.add('d-none');
            editMode.classList.remove('d-none');
        });
    });

    // Cancel edit
    document.querySelectorAll('.cancel-edit').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const viewMode = row.querySelector('.view-mode');
            const editMode = row.querySelector('.edit-mode');
            
            viewMode.classList.remove('d-none');
            editMode.classList.add('d-none');
        });
    });
});
</script>
@endpush
