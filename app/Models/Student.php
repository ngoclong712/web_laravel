<?php

namespace App\Models;

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
        'course_id',
    ];
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->age;
    }
}
