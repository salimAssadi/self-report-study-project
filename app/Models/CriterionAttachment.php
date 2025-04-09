<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterionAttachment extends Model
{
    
    use HasFactory;
    protected $table = 'attachments';
    protected $fillable = ['criterion_id', 'name_ar','name_en','evidence_code','file_path'];
}
