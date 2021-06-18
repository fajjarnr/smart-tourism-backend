<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'latitude',
        'longitude',
        'description',
        'name',
        'address',
        'rate',
        'image',
        'phone',
        'price',
        'hours',
        'facilities',
        'category_id',
        'types'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
