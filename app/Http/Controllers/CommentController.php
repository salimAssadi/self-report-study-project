<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Criterion;
use App\Models\CommentAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Display all comments across the system
     */
    public function allComments()
    {
        $comments = Comment::with(['user', 'replies', 'commentable', 'attachments'])
            ->whereNull('parent_id')
            ->latest()
            ->paginate(10);

        return view('self-study.comment.all', compact('comments'));
    }

    /**
     * Display comments for a specific criterion
     */
    public function index(Criterion $criterion)
    {
        $comments = $criterion->comments()->with(['user', 'replies', 'attachments'])->whereNull('parent_id')->latest()->paginate(10);
        return view('self-study.comment.index', compact('comments', 'criterion'));
    }

    /**
     * Show the form for creating a new comment
     */
    public function create()
    {
        $criteria = Criterion::all();
        return view('self-study.comment.create', compact('criteria'));
    }

    /**
     * Store a new comment for a criterion
     */
    public function store(Request $request, Criterion $criterion)
    {
        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
            'attachments.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,txt'
        ]);

        $comment = new Comment([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id
        ]);

        $criterion->comments()->save($comment);

        // Handle file attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('comment_attachments', $filename, 'public');

                $comment->attachments()->create([
                    'filename' => $filename,
                    'original_filename' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize()
                ]);
            }
        }

        return back()->with('success', 'Comment posted successfully!');
    }

    /**
     * Update the specified comment
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,txt'
        ]);

        $comment->update([
            'content' => $request->content
        ]);

        // Handle file attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('comment_attachments', $filename, 'public');

                $comment->attachments()->create([
                    'filename' => $filename,
                    'original_filename' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize()
                ]);
            }
        }

        return back()->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified comment
     */
    public function destroy(Comment $comment)
    {
        if(auth()->user()->can('Delete Comments')){

            foreach ($comment->attachments as $attachment) {
                Storage::disk('public')->delete('comment_attachments/' . $attachment->filename);
            }
            
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        }else{
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        
    }

    /**
     * Download a comment attachment
     */
    public function downloadAttachment(CommentAttachment $attachment)
    {
        $path = 'comment_attachments/' . $attachment->filename;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->download(
            $path,
            $attachment->original_filename
        );
    }
}
