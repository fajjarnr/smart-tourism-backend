<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class NewsFeed extends Model
{
    use HasFactory, SoftDeletes;

    // protected $guarded = [];
    protected $fillable = [
        'user_id', 'title', 'content', 'picturePath',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function banner()
    {
        return $this->belongsTo(Banner::class);
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
