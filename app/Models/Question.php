<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const QCM = 0;
    const TRUE_OR_FALSE = 1;
    use HasFactory;

    protected $fillable = [
        'question_title',
        'question_type',
        'question_order',
        'answers',
        'correct_answer',
        'formation_id'
    ];

    protected $hidden = [
        'correct_answer'
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
