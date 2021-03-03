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
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');

        if ($id) {
            $category = Category::find($id);

            if ($category)
                return ResponseFormatter::success(
                    $category,
                    'Data category berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data category tidak ada',
                    404
                );
        }

        $category = Category::query();

        if ($name)
            $category->where('name', 'like', '%' . $name . '%');

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data list category berhasil diambil'
        );
    }
}
