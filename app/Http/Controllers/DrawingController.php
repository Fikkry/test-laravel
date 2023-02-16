<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrawingController extends Controller
{
    public function index()
    {
        return view('draw');
    }

    public function store(Request $request)
    {
        if($request->canvas) {
            $folderPath = 'img/canvas/';
            $image_parts = explode(";base64,", $request->canvas);
            $image_type = "jpeg";
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $path = $folderPath . $signature;
            file_put_contents($path, $image_base64);
        }

        return redirect()->back();
    }
}
