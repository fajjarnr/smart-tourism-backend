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
            $banner = Banner::with(['news'])->orderBy('id', 'DESC')->get();
            return ResponseFormatter::success(
                $banner,
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
