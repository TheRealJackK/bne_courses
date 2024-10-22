<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        's_number', 
        'password', 
        'user_type'  // 'teacher' or 'student'
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // user (student or teacher) can be enrolled in many courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')->withTimestamps();
    }

    // teacher has many courses they teach
    public function taughtCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }
    
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    // Relation: A student submits many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function submittedReviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }
    
    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id');
    }
}