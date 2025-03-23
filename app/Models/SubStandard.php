<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubStandard extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_standard_id',
        'sequence',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'completion_status',
    ];

    public function mainStandard()
    {
        return $this->belongsTo(MainStandard::class, 'main_standard_id');
    }

    public function criteria()
    {
        return $this->morphMany(Criterion::class, 'standard');
    }
}