<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFormation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'formation_id',
        'current_done',
        'is_done'
    ];

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
