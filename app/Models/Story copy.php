<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'question',
        'options',
        'correct_answer',
        'end_phrase',
    ];

    protected $casts = [
        'options' => 'array',
    ];
}

