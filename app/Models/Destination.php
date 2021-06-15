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
        'picturePath',
        'phoneNumber',
        'price',
        'hours',
        'facilities',
        'category_id'
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

    public function toArray()
    {
        $toArray = parent::toArray();
        $toArray['picturePath'] = $this->picturePath;
        return $toArray;
    }

    public function getPicturePathAttribute()
    {
        return config('app.url') . Storage::url($this->attributes['picturePath']);
    }
}
