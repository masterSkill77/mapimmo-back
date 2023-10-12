<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'plans','total_amount', 'total_quantity','total_duration','user_id'
    ];

    protected $casts = [
        'plans' => 'json'
    ];

    public function user() :HasOne {
        return $this->hasOne(User::class, 'user_id');
    }
}
