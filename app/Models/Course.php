<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    protected function getYearCreatedAtAttribute()
    {
        return $this->created_at->format('Y');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
