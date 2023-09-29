<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formation extends Model
{
    protected $fillable = [
        'title',
        'duration',
        'description',
        'target_audience',
        'to_learn',
        'prerequisites',
        'included'
    ];
    use HasFactory;

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'formation_id');
    }
}
