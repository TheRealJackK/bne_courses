<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'reviewee_id', 
        'assessment_id', 
        'review_text', 
        'rating',
        'score' 
    ];

    // eview belongs to a student (the reviewer)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // review is given to another student (the reviewee)
    public function reviewee()
    {
        return $this->belongsTo(User::class, 'reviewee_id');
    }

    // review belongs to an assessment
    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }
    // user has sumbitted reviews
        public function submittedReviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    // user has recieved reviews
    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id');
    }
}