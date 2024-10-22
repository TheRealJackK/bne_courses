<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    // user belongs to
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // user belongs to course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
