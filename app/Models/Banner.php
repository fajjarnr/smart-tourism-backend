<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function destination()
    {
        return $this->hasMany(Destination::class, 'id', 'destination_id');
    }

    public function news()
    {
        return $this->hasMany(NewsFeed::class, 'id', 'news_id');
    }
}
