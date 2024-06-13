<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';

    protected $fillable = ['level_id', 'name', 'exam_type_id', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            $program->slug = Str::slug($program->name);
        });
    }

    public function examType(): BelongsTo
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    public function resource(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'program_subject', 'program_id', 'subject_id');
    }
}
