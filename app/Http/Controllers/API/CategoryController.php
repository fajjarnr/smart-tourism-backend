<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function fetch(Request $request)
    {
        $category = Category::with('destination')->get();
        return ResponseFormatter::success(
            $category,
            'Data list category berhasil diambil'
        );
    }
}
