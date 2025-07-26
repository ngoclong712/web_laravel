<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'birthdate',
        'status',
        'avatar',
        'course_id',
    ];
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->age;
    }

    public function getGenderNameAttribute()
    {
        return ($this->gender == '0') ? 'Male' : 'Female';
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
