<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    protected $fillable = [
        'type',
        'parent_id',
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

    // Relationship to parent Main Standard
    public function parent()
    {
        return $this->belongsTo(Standard::class, 'parent_id');
    }

    // Relationship to Sub-Standards
    public function children()
    {
        return $this->hasMany(Standard::class, 'parent_id');
    }

    // Scope to filter Main Standards
    public function scopeMain($query)
    {
        return $query->where('type', 'main');
    }

    // Scope to filter Sub-Standards
    public function scopeSub($query)
    {
        return $query->where('type', 'sub');
    }

    public function criteria()
    {
        return $this->hasMany(Criterion::class, 'standard_id');
    }
}