<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['course_code', 'name', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // student to course relation
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')->withTimestamps();
    }

    // course to assessment relation
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    // student to enrollments relation
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // 
    // public function enrolledStudents()
    // {
    //     return $this->belongsToMany(User::class, 'enrollments');
    // }
}
