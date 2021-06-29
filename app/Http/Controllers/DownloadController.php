<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download()
    {
        try {
            return Storage::download('public\apk\stp.apk');
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
