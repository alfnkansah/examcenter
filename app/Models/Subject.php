<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['level_id', 'name', 'exam_type_id', 'slug', 'tag'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subject) {
            $subject->slug = Str::slug($subject->name);
        });
    }


    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    public function resource()
    {
        return $this->hasMany(Resource::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
