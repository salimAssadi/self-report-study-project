<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainStandard extends Model
{
    use HasFactory;

    protected $fillable = [
        'sequence',
        'name_ar',
        'name_en',
        'introduction_ar',
        'introduction_en',
        'description_ar',
        'description_en',
        'summary_ar',
        'summary_en',
        'completion_status',
    ];

    // Relationship: A main standard has many sub-standards
    public function subStandards()
    {
        return $this->hasMany(SubStandard::class, 'main_standard_id');
    }

    // Relationship: A main standard can have criteria (polymorphic relationship)
    public function criteria()
    {
        return $this->morphMany(Criterion::class, 'standard');
    }
}