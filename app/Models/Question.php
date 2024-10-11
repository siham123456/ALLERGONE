<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'allergen',
        'text',
        'correct_answer',
        'image',
        'correct_feedback_image',
        'correct_feedback_text',
        'wrong_feedback_image',
        'wrong_feedback_text',
    ];
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

