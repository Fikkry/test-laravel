<?php

use App\Events\MessageCreated;
use App\Models\Message;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    return view('welcome');
});


Route::get('/message/created', function () {
    $message = Message::create([
        'title' => 'message-number-'. rand(),
        'message' => 'lorem ipsum dolor sit amet',
        'status' => false
    ]);

    MessageCreated::dispatch($message);
});

Route::get('drawing', [App\Http\Controllers\DrawingController::class, 'index']);
Route::post('drawing', [App\Http\Controllers\DrawingController::class, 'store']);

Route::get('/message', function () {
    $messages = Message::where('status', false)->get();

    return response()->json($messages);
});

//Media library routes
Route::get('/medialibrary', [App\Http\Controllers\MediaLibraryController::class, 'mediaLibrary'])->name('media-library');

//FILE UPLOADS CONTROLER
Route::post('medialibrary/upload', [App\Http\Controllers\UploaderController::class, 'upload'])->name('file-upload');
Route::post('medialibrary/delete', [App\Http\Controllers\UploaderController::class, 'delete'])->name('file-delete');