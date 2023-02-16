<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaLibraryController extends Controller
{
    public function mediaLibrary(Request $request)
    {
        $media_obj = Media::all();

        return view('medialibrary', compact('media_obj'));
    }
}
