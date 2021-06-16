<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Destination;
use App\Models\NewsFeed;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        $category = Category::all();
        $destination = Destination::all();
        $banner = Banner::all();
        $news = NewsFeed::all();
        return view('dashboard', [
            'user' => $user,
            'category' => $category,
            'destination' => $destination,
            'banner' => $banner,
            'news' => $news
        ]);
    }
}
