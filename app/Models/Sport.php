<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    /**
     * Get the sports for the student.
     */
    public function student_sports()
    {
        return $this->belongsToMany(Student::class,'student_sports');
    }
}
