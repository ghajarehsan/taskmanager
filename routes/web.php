<?php

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


//$table->string('name');
//
//$table->string('type');
//
//$table->integer('duration')->nullable();
//
//$table->integer('size');
//
//$table->boolean('is_private')->default(0)->comment('0:public,1:private');
//
//$table->bigInteger('fileable_id')->unsigned();
//
//$table->string('fileable_type');

Route::get('/', function () {
    return view('welcome');
});
