@extends('layouts.admin-app')
@section('page-title')
    {{ __('Comments') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        {{ __('Comments') }}

    </li>
    @php
        $profile = asset(Storage::url('upload/profile'));
    @endphp
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="mb-0 text-primary">{{ __('Comments for Criterion:') }} :<span class="text-danger">{{ $criterion->name }}</span></h5>
                    <a href="{{ route('criteria.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    <!-- Comment Form -->
                    <form action="{{ route('criterion.comments.store', $criterion->id) }}" class="card shadow-sm p-3"
                        method="POST" enctype="multipart/form-data" class="comment-form">
                        @csrf
                        <div class="input-group mb-3">
                            <!-- Attachments Button -->
                            <label class="btn btn-light rounded-circle me-2" style="cursor: pointer;  height: fit-content;">
                                <i class="fas fa-paperclip"></i>
                                <input type="file" class="d-none @error('attachments.*') is-invalid @enderror"
                                    id="attachments" name="attachments[]" multiple>
                            </label>
                            <!-- Text Input -->
                            <textarea name="content" class="form-control border-0 shadow-none @error('content') is-invalid @enderror"
                                placeholder="{{ __('Write your comment here...') }}" rows="1" required></textarea>
                            <!-- Send Button -->
                            <button type="submit" class="btn btn-primary rounded-circle ms-2" style="height: fit-content;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                        <!-- Validation Feedback -->
                        @error('content')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        @error('attachments.*')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        <div class="form-text small">{{ __('Max file size: 10MB. You can upload multiple files.') }}</div>
                    </form>

                    <!-- Comments List -->
                    <div class="comments-list">
                        @forelse($comments as $comment)
                            <div class="comment-item card mb-3 shadow-sm" id="comment-{{ $comment->id }}">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <!-- Avatar -->
                                        <div class="me-3">
                                            <img src="{{ !empty($comment->user->profile) ? @$profile . '/' . $comment->user->profile : $profile . '/avatar.png' }}"
                                                alt="{{ $comment->user->name }}" class="rounded-circle"
                                                style="width: 40px; height: 40px;">

                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="card-subtitle text-muted small">{{ $comment->user->full_name }}
                                                    <br>
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </h6>
                                                @if (auth()->id() == $comment->user_id)
                                                    <div class="comment-actions">
                                                        <button
                                                            class="btn btn-sm btn-link text-decoration-none edit-comment"
                                                            data-comment-id="{{ $comment->id }}">
                                                            <i class="ti ti-edit"></i>
                                                        </button>
                                                        <form action="{{ route('comments.destroy', $comment->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-link text-danger text-decoration-none"
                                                                onclick="return confirm('{{ __('Are you sure you want to delete this comment?') }}')">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="card-text comment-content mt-2">{{ $comment->content }}</p>
                                            @if ($comment->attachments->count() > 0)
                                                <div class="attachments mt-2">
                                                    <h6 class="text-muted">{{ __('Attachments') }}:</h6>
                                                    <div class="list-group">
                                                        @foreach ($comment->attachments as $attachment)
                                                            <a href="{{ route('comments.attachment.download', $attachment->id) }}"
                                                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <i class="fas fa-paperclip me-2"></i>
                                                                    {{ $attachment->original_filename }}
                                                                </div>
                                                                <span class="badge bg-primary rounded-pill">
                                                                    {{ number_format($attachment->size / 1024, 1) }} KB
                                                                </span>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- Edit Form (Hidden by default) -->
                                            <form action="{{ route('comments.update', $comment->id) }}"
                                                method="POST" class="edit-form d-none card shadow-sm p-3 position-relative"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group mb-3 ">
                                                    <!-- Text Input -->
                                                    <label class="btn btn-light rounded-circle me-2" style="cursor: pointer; height: fit-content;">
                                                        <i class="fas fa-paperclip"></i>
                                                        <input type="file" class="d-none @error('attachments.*') is-invalid @enderror"
                                                            id="edit-attachments-{{ $comment->id }}" name="attachments[]" multiple>
                                                            
                                                    </label>
                                                    <textarea name="content" class="form-control border-0 shadow-none" placeholder="{{ __('Edit your comment...') }}"
                                                        rows="1" required>{{ $comment->content }}</textarea>
                                                    <!-- Send Button -->
                                                    <button type="submit"  class="btn btn-primary rounded-circle ms-2" >
                                                        <i class="fas fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                        
                                                <button type="button"
                                                    class="btn btn-sm cancel-edit btn-close position-absolute" style="right: 5px;bottom: 11px; height: fit-content;"><i class="btn-close"></i></button>
                                            </form>
                                            <!-- Reply Button -->
                                            <button
                                                class="btn btn-sm btn-link text-decoration-none show-reply-form mt-2"> <i class="fas fa-reply me-1"></i>{{ __('Reply') }}</button>
                                            <!-- Reply Form -->
                                            <form action="{{ route('criterion.comments.store', $criterion->id) }}"
                                                method="POST" class="reply-form d-none mt-2 card shadow-sm p-3 position-relative"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <div class="input-group mb-3">
                                                    <!-- Text Input -->
                                                    
                                                        <label class="btn btn-light rounded-circle me-2" style="cursor: pointer; height: fit-content;">
                                                            <i class="fas fa-paperclip"></i>
                                                            <input type="file"
                                                            class="d-none @error('attachments.*') is-invalid @enderror"
                                                            id="reply-attachments-{{ $comment->id }}" name="attachments[]"
                                                            multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.txt">
                                                                
                                                        </label>
                                                    <textarea name="content" class="form-control border-0 shadow-none" placeholder="{{ __('Write your reply...') }}"
                                                        rows="1" required></textarea>
                                                    <!-- Send Button -->
                                                    <button type="submit" class="btn btn-primary rounded-circle ms-2">
                                                        <i class="fas fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                                <!-- Attachments -->
                                                <div class="mb-3">
                                                    @error('attachments.*')
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <button type="button"
                                                class="btn btn-sm cancel-reply btn-close position-absolute" style="right: 5px;bottom: 11px; height: fit-content;"><i class="btn-close"></i></button>
                                                
                                            </form>
                                            <!-- Replies -->
                                            @if ($comment->replies->count() > 0)
                                                <div class="replies mt-3 ms-4">
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="reply card mb-2 shadow-sm">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <!-- Avatar -->
                                                                    <div class="me-3">
                                                                        <img src="{{ !empty($reply->user->profile) ? @$profile . '/' . $reply->user->profile : $profile . '/avatar.png' }}"
                                                                            alt="{{ $reply->user->full_name }}"
                                                                            class="rounded-circle"
                                                                            style="width: 40px; height: 40px;">
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center">
                                                                            <h6 class="card-subtitle text-muted small">
                                                                                {{ $reply->user->full_name }} <br>
                                                                                {{ $reply->created_at->diffForHumans() }}
                                                                            </h6>
                                                                            @if (auth()->id() == $reply->user_id)
                                                                                <div class="reply-actions">
                                                                                    <form
                                                                                        action="{{ route('comments.destroy', $reply->id) }}"
                                                                                        method="POST" class="d-inline">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="btn btn-sm btn-link text-danger text-decoration-none"
                                                                                            onclick="return confirm('{{ __('Are you sure you want to delete this reply?') }}')">
                                                                                            <i class="ti ti-trash"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <p class="card-text">{{ $reply->content }}</p>
                                                                        @if ($reply->attachments->count() > 0)
                                                                            <div class="attachments mt-2">
                                                                                <h6 class="text-muted">
                                                                                    {{ __('Attachments:') }}</h6>
                                                                                <div class="list-group">
                                                                                    @foreach ($reply->attachments as $attachment)
                                                                                        <a href="{{ route('comments.attachment.download', $attachment->id) }}"
                                                                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                                                            <div>
                                                                                                <i
                                                                                                    class="fas fa-paperclip me-2"></i>
                                                                                                {{ $attachment->original_filename }}
                                                                                            </div>
                                                                                            <span
                                                                                                class="badge bg-primary rounded-pill">
                                                                                                {{ number_format($attachment->size / 1024, 1) }}
                                                                                                KB
                                                                                            </span>
                                                                                        </a>
                                                                                    @endforeach
                                                                                </div>
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
                            <div class="alert alert-info text-center">
                                {{ __('No comments yet. Be the first to comment!') }}</div>
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

        .comment-form {
            /* border: 1px solid #ddd; */
            border-radius: 30px;
            padding: 0.5rem 1rem;
            background-color: #ffffff;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);

        }

        .comment-form textarea {
            resize: none;
            overflow-y: hidden;
            max-height: 80px;
            min-height: 36px;
        }

        .comment-form .btn-primary {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .comment-form .btn-light {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
        }

        .rounded-circle {
            object-fit: cover;
        }

        .fa-paperclip,
        .fa-paper-plane {
            font-size: 18px;
        }

        .edit-form,
        .reply-form {
            /* border: 1px solid #ddd; */
            border-radius: 10px;
            padding: 0.5rem 1rem;
            background-color: #ffffff;
        }

        .edit-form textarea,
        .reply-form textarea {
            resize: none;
            overflow-y: hidden;
            max-height: 80px;
            min-height: 36px;
        }

        .edit-form .btn-primary,
        .reply-form .btn-primary {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit-form .btn-light,
        .reply-form .btn-light {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
        }

        .fa-paperclip,
        .fa-paper-plane {
            font-size: 18px;
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
