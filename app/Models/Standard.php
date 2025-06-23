<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Localizable;
use App\Models\User;

class Standard extends Model
{
    use Localizable;
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

    public function parent()
    {
        return $this->belongsTo(Standard::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Standard::class, 'parent_id');
    }
    public function criteria()
    {
        return $this->hasMany(Criterion::class, 'standard_id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_standards')
            ->withTimestamps();
    }


    public function scopeMain($query)
    {
        return $query->where('type', 'main');
    }

    public function scopeSub($query)
    {
        return $query->where('type', 'sub');
    }



    public function getNameAttribute()
    {
        return $this->getLocalizedAttribute('name');
    }


    public function getIntroductionAttribute()
    {
        return $this->getLocalizedAttribute('introduction');
    }


    public function getDescriptionAttribute()
    {
        return $this->getLocalizedAttribute('description');
    }


    public function getSummaryAttribute()
    {
        return $this->getLocalizedAttribute('summary');
    }
    public function getTotalCriteriaCountAttribute()
    {
        $directCount = $this->criteria()->count();
        $childrenCount = $this->children->sum('criteria_count');
        return $directCount + $childrenCount;
    }

    public function getCriteriaCountAttribute()
    {
        return $this->criteria()->count();
    }
}