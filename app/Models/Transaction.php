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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function destinations()
    {
        return $this->hasOne(Destination::class, 'id', 'destination_id');
    }

    // public function locations()
    // {
    //     return $this->hasOne(Location::class, 'id', 'location_id');
    // }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
