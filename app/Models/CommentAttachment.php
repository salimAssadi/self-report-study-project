<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'filename',
        'original_filename',
        'mime_type',
        'size'
    ];

    /**
     * Get the comment that owns the attachment.
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
