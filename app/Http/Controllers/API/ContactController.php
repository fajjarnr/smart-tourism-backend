<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function post(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'message' => 'required'
            ]);

            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->save();

            return ResponseFormatter::success(
                $contact,
                'Saran dan masukan berhasil disimpan'
            );
        } catch (\Throwable $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Data gagal di disimpan', 404);
        }
    }
}
