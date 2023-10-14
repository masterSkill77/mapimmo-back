<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'plans', 'total_amount', 'total_quantity', 'total_duration', 'user_id', 'num_invoice'
    ];

    protected $casts = [
        'plans' => 'json'
    ];
    /**
     * Belongs to mais pas HasOne
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
