<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'latitude',
        'longitude',
        'description',
        'name',
        'address',
        'rate',
        'image',
        'phoneNumber',
        'price',
        'hours',
        'facilities',
        'category_id'
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
