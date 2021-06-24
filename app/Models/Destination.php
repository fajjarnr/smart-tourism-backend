<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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

    // public function toArray()
    // {
    //     return [
    //         'image'  => asset('storage/images/destinations/' . $this->image)
    //     ];
    // }

    // public function getImagePathAttribute()
    // {
    //     return config('app.url') . Storage::url('images/destinations', $this->image);
    // }
}
