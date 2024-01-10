<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Included extends Model
{
    use HasFactory;

    protected $table = 'included';
    protected $fillable = [
        'file_name',
        'formation_id'
    ];

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function getFullFilePathAttribute()
    {
        return asset('storage/' . $this->file_name);
    }
}
