<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'destination_id',
        'user_id',
        'quantity',
        'total',
        'status',
        'payment_url'
    ];

    public function destination()
    {
        return $this->hasOne(Destination::class, 'id', 'destination_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
