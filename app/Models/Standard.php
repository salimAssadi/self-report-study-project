<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Localizable;

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

    public function scopeMain($query)
    {
        return $query->where('type', 'main');
    }

    public function scopeSub($query)
    {
        return $query->where('type', 'sub');
    }

    public function criteria()
    {
        return $this->hasMany(Criterion::class, 'standard_id');
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
}