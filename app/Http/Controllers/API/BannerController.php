<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function all()
    {
        try {
            $destination = Banner::with(['destination'])->get();
            return ResponseFormatter::success(
                $destination,
                'Data Banner berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Data gagal di ambil', 404);
        }
    }
}
