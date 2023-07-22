<?php

use App\Http\Controllers\FileController;
use App\Mail\FileMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('create');
})->name('home');

Route::post('upload/file',[FileController::class,'store'])->name('uploadFile');

Route::get('/download/file',function () {
    return view('downloadForm');
})->name('download.form');

Route::get('/preview/file/{fileId?}',[FileController::class, 'preview'])->name('preview');

Route::get('/files/download-zip/{fileId?}', [FileController::class, 'downloadZip'])->name('download');
Route::get('/files/download/{file}', [FileController::class, 'download'])->name('download.file');

