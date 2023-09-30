<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'duration',
        'description',
        'target_audience',
        'to_learn',
        'prerequisites',
        'included',
        'uuid',
        'labels'
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'formation_id');
    }

    public function chapters(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'formation_id');
    }
}
