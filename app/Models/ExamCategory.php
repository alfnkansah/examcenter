<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCategory extends Model
{
    protected $fillable = ['name', 'slug', 'exam_type_id', 'level_id'];

    use HasFactory;

    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    public function resource()
    {
        return $this->hasMany(Resource::class);
    }
}
