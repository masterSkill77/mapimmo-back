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
        'uuid',
        'labels',
        'photo',
        'theme'
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'formation_id');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, 'formation_id');
    }
    public function usersTaking(): HasMany
    {
        return $this->hasMany(UserFormation::class);
    }
    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class);
    }
    public function included(): HasMany
    {
        return $this->hasMany(Included::class, 'formation_id');
    }
}
