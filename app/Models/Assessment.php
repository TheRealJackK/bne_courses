<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessment extends Model
{
    use HasFactory;

    // assessment fields
    protected $fillable = [
        'title', 
        'instruction', 
        'num_reviews_required', 
        'max_score', 
        'due_date', 
        'type', 
        'course_id'
    ];

    // assessment to course relation
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // assessment to review relation
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}