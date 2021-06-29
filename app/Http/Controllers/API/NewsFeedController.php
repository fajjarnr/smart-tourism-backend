<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\NewsFeed;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    public function all()
    {
        $newsFeed = NewsFeed::orderBy('id', 'DESC')->with(['user'])->get();

        return ResponseFormatter::success(
            $newsFeed,
            'Data berita berhasil diambil'
        );
    }
}
