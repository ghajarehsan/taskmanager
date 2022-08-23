<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FileController;

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

Route::get('/test', function () {
    return view('welcome');
});

Route::group(['prefix' => 'file'], function () {

    Route::get('index', [FileController::class, 'index'])->name('file.index');

    Route::post('upload', [FileController::class, 'upload'])->name('file.upload');

});
