<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function wisataAlam()
    {
        return $this->hasOne(WisataAlam::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
