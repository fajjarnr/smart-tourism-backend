<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    // protected $guarded = [];
    protected $fillable = [
        'picturePath',
        // 'destination_id',
        'news_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    // public function destination()
    // {
    //     return $this->hasOne(Destination::class, 'id', 'destination_id');
    // }

    public function news()
    {
        return $this->hasOne(NewsFeed::class, 'id', 'news_id');
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
