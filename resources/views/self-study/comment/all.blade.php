@extends('layouts.admin-app')

@section('page-title')
    {{ __('All Comments') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('All Comments') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('All Comments') }}</h5>
                <a href="{{ route('admin.comments.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i>
                    {{ __('Create Comment') }}
                </a>
            </div>
            <div class="card-body">
                <!-- Comments List -->
                <div class="comments-list">
                    @forelse($comments as $comment)
                        <div class="comment-item card mb-3" id="comment-{{ $comment->id }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            {{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}
                                        </h6>
                                        <small class="text-muted">
                                            @if($comment->commentable_type == 'App\Models\Criterion')
                                                {{ __('On Criterion:') }} 
                                                <a href="{{ route('admin.criterion.comments.index', $comment->commentable->id) }}">
                                                    {{ $comment->commentable->name }}
                                                </a>
                                            @else
                                                {{ __('On:') }} {{ class_basename($comment->commentable_type) }}
                                            @endif
                                        </small>
                                    </div>
                                    @if(auth()->id() == $comment->user_id)
                                        <div class="comment-actions">
                                            <button class="btn btn-sm btn-link edit-comment" data-comment-id="{{ $comment->id }}">
                                                <i class="ti ti-pencil"></i>
                                                {{ __('Edit') }}
                                            </button>
                                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-link text-danger" onclick="return confirm('{{ __('Are you sure you want to delete this comment?') }}')">
                                                    <i class="ti ti-trash"></i>
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <p class="card-text comment-content mt-2">{{ $comment->content }}</p>
                                
                                <!-- Edit Form (Hidden by default) -->
                                <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST" class="edit-form d-none">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <textarea name="content" class="form-control" rows="3" required>{{ $comment->content }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">
                                        <i class="ti ti-check"></i>
                                        {{ __('Save') }}
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary mt-2 cancel-edit">
                                        <i class="ti ti-x"></i>
                                        {{ __('Cancel') }}
                                    </button>
                                </form>

                                <!-- Replies -->
                                @if($comment->replies->count() > 0)
                                    <div class="replies mt-3 ms-4">
                                        @foreach($comment->replies as $reply)
                                            <div class="reply card mb-2">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h6 class="card-subtitle mb-2 text-muted">{{ $reply->user->name }} - {{ $reply->created_at->diffForHumans() }}</h6>
                                                        @if(auth()->id() == $reply->user_id)
                                                            <div class="reply-actions">
                                                                <form action="{{ route('admin.comments.destroy', $reply->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-link text-danger" onclick="return confirm('{{ __('Are you sure you want to delete this reply?') }}')">
                                                                        <i class="ti ti-trash"></i>
                                                                        {{ __('Delete') }}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <p class="card-text">{{ $reply->content }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-container">
                                <div class="empty-state-icon">
                                    <i class="ti ti-messages-off"></i>
                                </div>
                                <p class="empty-state-description">{{ __('No comments found.') }}</p>
                            </div>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit Comment
        document.querySelectorAll('.edit-comment').forEach(button => {
            button.addEventListener('click', function() {
                const commentItem = this.closest('.comment-item');
                const content = commentItem.querySelector('.comment-content');
                const editForm = commentItem.querySelector('.edit-form');
                
                content.classList.add('d-none');
                editForm.classList.remove('d-none');
            });
        });

        // Cancel Edit
        document.querySelectorAll('.cancel-edit').forEach(button => {
            button.addEventListener('click', function() {
                const commentItem = this.closest('.comment-item');
                const content = commentItem.querySelector('.comment-content');
                const editForm = commentItem.querySelector('.edit-form');
                
                content.classList.remove('d-none');
                editForm.classList.add('d-none');
            });
        });
    });
</script>
@endpush
