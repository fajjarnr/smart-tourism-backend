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
        'image',
        'destination_id',
        'news_feed_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function destination()
    {
        return $this->hasOne(Destination::class, 'id', 'destination_id');
    }

    public function news()
    {
        return $this->hasOne(NewsFeed::class, 'id', 'news_feed_id');
    }

    public function getPicturePathAttribute()
    {
        return config('app.url') . Storage::url($this->attributes['image']);
    }
}
