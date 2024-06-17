<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamCategory extends Model
{
    protected $fillable = ['name', 'slug', 'exam_type_id', 'level_id'];

    use HasFactory;

    public function examType(): BelongsTo
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }
}
