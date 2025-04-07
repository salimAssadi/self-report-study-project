@extends('layouts.admin-app')
@section('page-title')
    {{ __('Comments') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        {{ __('Comments') }}

    </li>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                        <h5 class="mb-0 text-primary">{{ __('Comments for Criterion:') }} {{ $criterion->name_ar }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- Comment Form -->
                        <form action="{{ route('admin.criterion.comments.store', $criterion->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="form-floating">
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="floatingTextarea" rows="3" placeholder="{{ __('Write your comment here...') }}" required></textarea>
                                <label for="floatingTextarea">{{ __('Write your comment here...') }}</label>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">{{ __('Post Comment') }}</button>
                        </form>
    
                        <!-- Comments List -->
                        <div class="comments-list">
                            @forelse($comments as $comment)
                                <div class="comment-item card mb-3 shadow-sm" id="comment-{{ $comment->id }}">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <!-- Avatar and User Info -->
                                            <div class="d-flex align-items-center me-3">
                                                <img src="{{ $comment->user->avatar ?? 'https://via.placeholder.com/40' }}" alt="{{ $comment->user->name }}" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                                <div>
                                                    <h6 class="mb-0 small">{{ $comment->user->email }}</h6>
                                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="card-text comment-content">{{ $comment->content }}</p>
                                                <!-- Edit Form (Hidden by default) -->
                                                <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST" class="edit-form d-none">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-floating mb-3">
                                                        <textarea name="content" class="form-control" id="editTextarea{{ $comment->id }}" rows="3" required>{{ $comment->content }}</textarea>
                                                        <label for="editTextarea{{ $comment->id }}">{{ __('Edit your comment...') }}</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-primary">{{ __('Save') }}</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary cancel-edit">{{ __('Cancel') }}</button>
                                                </form>
                                                <!-- Reply Button -->
                                                <div class="mt-3 d-flex align-items-center">
                                                    <button class="btn btn-sm btn-link text-decoration-none show-reply-form me-2">
                                                        <i class="fas fa-reply me-1"></i> {{ __('Reply') }}
                                                    </button>
                                                    @if(auth()->id() == $comment->user_id)
                                                        <div class="comment-actions">
                                                            <button class="btn btn-sm btn-link text-decoration-none edit-comment" data-comment-id="{{ $comment->id }}">
                                                                {{ __('Edit') }}
                                                            </button>
                                                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none" onclick="return confirm('{{ __('Are you sure you want to delete this comment?') }}')">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- Reply Form -->
                                                <form action="{{ route('admin.criterion.comments.store', $criterion->id) }}" method="POST" class="reply-form d-none mt-2">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <div class="form-floating mb-3">
                                                        <textarea name="content" class="form-control" id="replyTextarea{{ $comment->id }}" rows="2" placeholder="{{ __('Write your reply...') }}" required></textarea>
                                                        <label for="replyTextarea{{ $comment->id }}">{{ __('Write your reply...') }}</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-primary">{{ __('Post Reply') }}</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary cancel-reply">{{ __('Cancel') }}</button>
                                                </form>
                                                <!-- Replies -->
                                                @if($comment->replies->count() > 0)
                                                    <div class="replies mt-3 ms-4">
                                                        @foreach($comment->replies as $reply)
                                                            <div class="reply card mb-2 shadow-sm">
                                                                <div class="card-body">
                                                                    <div class="d-flex">
                                                                        <!-- Avatar and User Info -->
                                                                        <div class="d-flex align-items-center me-3">
                                                                            <img src="{{ $reply->user->avatar ?? 'https://via.placeholder.com/40' }}" alt="{{ $reply->user->name }}" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                                                            <div>
                                                                                <h6 class="mb-0 small">{{ $reply->user->name }}</h6>
                                                                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <p class="card-text">{{ $reply->content }}</p>
                                                                            @if(auth()->id() == $reply->user_id)
                                                                                <div class="reply-actions">
                                                                                    <form action="{{ route('admin.comments.destroy', $reply->id) }}" method="POST" class="d-inline">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none" onclick="return confirm('{{ __('Are you sure you want to delete this reply?') }}')">
                                                                                            {{ __('Delete') }}
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info text-center">{{ __('No comments yet. Be the first to comment!') }}</div>
                            @endforelse
                            <!-- Pagination -->
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css-page')
<style>
    .comment-item {
        transition: box-shadow 0.3s ease;
    }
    .comment-item:hover {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .form-floating textarea:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .btn-link {
        padding: 0;
    }
    .rounded-circle {
        object-fit: cover;
    }
    .fa-reply {
        color: #0d6efd;
    }
</style>
@endpush

@push('script-page')
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
        // Show Reply Form
        document.querySelectorAll('.show-reply-form').forEach(button => {
            button.addEventListener('click', function() {
                const replyForm = this.nextElementSibling;
                this.classList.add('d-none');
                replyForm.classList.remove('d-none');
            });
        });
        // Cancel Reply
        document.querySelectorAll('.cancel-reply').forEach(button => {
            button.addEventListener('click', function() {
                const replyForm = this.closest('.reply-form');
                const showReplyButton = replyForm.previousElementSibling;
                replyForm.classList.add('d-none');
                showReplyButton.classList.remove('d-none');
            });
        });
    });
</script>
@endpush