<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Traits\Localizable;

class Criterion extends Model
{
    use HasFactory, SoftDeletes;
    use Localizable;
    protected $fillable = [
        'standard_id',
        'sequence',
        'name_ar',
        'name_en',
        'content_ar',
        'content_en',
        'is_met',
        'fulfillment_status',
    ];

    protected $casts = [
        'standard_type' => 'string',
    ];

    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standard_id');
    }

    public function links()
    {
        return $this->hasMany(CriterionLink::class);
    }

    public function attachments()
    {
        return $this->hasMany(CriterionAttachment::class);
    }

    /**
     * Get all comments for the criterion.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getNameAttribute()
    {
        return $this->getLocalizedAttribute('name');
    }

    /**
     * Get the localized content attribute.
     *
     * @return string
     */
    public function getContentAttribute()
    {
        return $this->getLocalizedAttribute('content');
    }
}
