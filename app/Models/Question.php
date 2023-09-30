<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quesiton_title',
        'quesiton_type',
        'question_order',
        'answers',
        'correct_answer',
        'formation_id'
    ];
}
