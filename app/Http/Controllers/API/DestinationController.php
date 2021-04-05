<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function all()
    {
        $destination = Destination::all();
        return ResponseFormatter::success(
            $destination,
            'Data destinasi berhasil diambil'
        );
    }

    public function fetch($category_id)
    {
        try {
            $destination = Destination::where('category_id', $category_id)->paginate(6);
            return ResponseFormatter::success(
                $destination,
                'Data list destinasi sesuai category berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Data gagal di ambil', 404);
        }
    }
}