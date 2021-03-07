<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Location;

class LocationController extends Controller
{

    public function all()
    {
        $location = Location::all();
        return ResponseFormatter::success(
            $location,
            'Data location berhasil diambil'
        );
    }

    public function fetch($category_id)
    {
        try {
            $location = Location::where('category_id', $category_id)->paginate(6);
            return ResponseFormatter::success(
                $location,
                'Data list location sesuai category berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Data gagal di ambil', 404);
        }
    }
}
