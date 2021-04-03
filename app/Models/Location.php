<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    // protected $guarded = [];

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
        'user_id',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }

    public function banner()
    {
        return $this->belongsTo(Banner::class, 'id', 'banner_id');
    }
}
