<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterionLink extends Model
{   
    protected $table = 'links';
    use HasFactory;
    protected $fillable = ['criterion_id', 'name_ar','name_en','url'];

}
