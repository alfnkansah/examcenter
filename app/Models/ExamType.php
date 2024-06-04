<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'short_name'];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function categories()
    {
        return $this->hasMany(ExamCategory::class);
    }
}
