<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function formation() : BelongsTo
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }
}
