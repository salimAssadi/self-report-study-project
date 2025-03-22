<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    use HasFactory;

    protected $fillable = [
        'standard_id',
        'standard_type',
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
        return $this->morphTo();
    }

    public function links()
    {
        return $this->hasMany(CriterionLink::class);
    }
    public function attachments()
    {
        return $this->hasMany(CriterionAttachment::class);
    }
}
