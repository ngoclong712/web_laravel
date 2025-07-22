<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Student extends Model
{
    public $timestamps = false;
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['first_name'] . " " . $attributes['last_name'],
        );
    }
    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) =>
            Carbon::parse($attributes['birthdate'])->age
        );
    }
    protected function genderName(): Attribute
    {
        return Attribute::make(
            get: function($value, $attributes)
            {
                return ($attributes['gender'] === 0) ? 'Male' : 'Female';
            }
        );
    }
}
