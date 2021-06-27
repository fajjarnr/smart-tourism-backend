<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function all(Request $request)
    {
        try {
            $destination = Destination::all();
            return ResponseFormatter::success(
                $destination,
                'Data destinasi berhasil diambil'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Data gagal di ambil', 404);
        }
    }

    public function query(Request $request)
    {
        try {
            $id = $request->input('id');
            $limit = $request->input('limit', 10);
            $name = $request->input('name');
            $types = $request->input('types');

            $price_from = $request->input('price_from');
            $price_to = $request->input('price_to');

            $rate_from = $request->input('rate_from');
            $rate_to = $request->input('rate_to');

            if ($id) {
                $destination = Destination::find($id);

                if ($destination)
                    return ResponseFormatter::success(
                        $destination,
                        'Data destinasi berhasil diambil'
                    );
                else
                    return ResponseFormatter::error(
                        null,
                        'Data destinasi tidak ada',
                        404
                    );
            }

            $destination = Destination::query();

            if ($name)
                $destination->where('name', 'like', '%' . $name . '%');

            if ($types)
                $destination->where('types', 'like', '%' . $types . '%');

            if ($price_from)
                $destination->where('price', '>=', $price_from);

            if ($price_to)
                $destination->where('price', '<=', $price_to);

            if ($rate_from)
                $destination->where('rate', '>=', $rate_from);

            if ($rate_to)
                $destination->where('rate', '<=', $rate_to);

            return ResponseFormatter::success(
                $destination->paginate($limit),
                'Data destinasi berhasil diambil'
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
            $destination = Destination::with(['category'])->where('category_id', $category_id)->paginate(10);
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
