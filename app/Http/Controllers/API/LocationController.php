<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function all()
    {
        try {
            $location = Location::with(['category'])->get();
            return ResponseFormatter::success(
                $location,
                'Data lokasi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Data gagal di ambil', 404);
        }
    }

    public function fetch($category_id)
    {
        try {
            $location = Location::with(['category'])->where('category_id', $category_id)->paginate(6);
            return ResponseFormatter::success(
                $location,
                'Data list lokasi sesuai kategori berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Data gagal di ambil', 404);
        }
    }
}
