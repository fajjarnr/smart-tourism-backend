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

    public function toArray()
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'rate' => $this->rate,
            'phone' => $this->phone,
            'price' => $this->price,
            'hours' => $this->hours,
            'facilities' => $this->facilities,
            'types' => $this->types,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'image'  => asset('storage/images/destinations/' . $this->image),
            'category' => $this->category,
        ];
    }
}
