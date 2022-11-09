<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d');
    }

    function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst(strtolower($value));
    }

    function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst(strtolower($value));
    }

    /**
     * Get the student dob.
     *
     * @return string
     */
    public function getDobAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->format('d/m/Y');
    }

    /**
     * Get the sports for the student.
     */
    public function student_sports()
    {
        return $this->belongsToMany(Sport::class, 'student_sports');
    }
}
