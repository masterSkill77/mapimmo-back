<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'order',
        'formation_id'
    ];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
