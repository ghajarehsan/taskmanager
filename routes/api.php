<?php

use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TicketController;
use \App\Http\Controllers\Api\LoginController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/createTicket', [TestController::class, 'createTicket']);

Route::get('/createTicketLevel', [TestController::class, 'createTicketLevel']);

Route::get('/createDepartmentLevel', [TestController::class, 'createDepartmentLevel']);

Route::get('/getCreatedTickets', [TestController::class, 'getCreatedTickets']);

Route::get('/getAcceptedTickets', [TestController::class, 'getAcceptedTickets']);

Route::get('/addTask', [TestController::class, 'addTask']);

Route::get('/addSubTask', [TestController::class, 'addSubTask']);


Route::group(['prefix' => 'v1'], function () {

    Route::get('getAllTicket', [TicketController::class, 'getAllTicket']);

    Route::group(['prefix' => 'file'], function () {

        Route::post('upload', [FileController::class, 'upload'])->name('file.upload');
    });

    Route::group(['prefix' => 'auth'], function () {

        Route::post('insertPhoneNumber', [LoginController::class, 'insertPhoneNumber'])->name('auth.insertPhoneNumber');

        Route::post('loginByCode', [LoginController::class, 'loginByCode']);

        Route::post('logout', [LoginController::class, 'logout'])->middleware(['auth:sanctum']);

        Route::post('setPassword', [LoginController::class, 'setPassword'])->middleware(['auth:sanctum']);

        Route::post('loginByConstancePassword', [LoginController::class, 'loginByConstancePassword']);

    });
});


Route::get('/tokens/create', function (Request $request) {

    $user = new \App\Models\User();

    $user = $user->find(2);

    $token = $user->createToken('api token', ['update']);

    return ['token' => $token->plainTextToken];
});

Route::get('testEhsan2', function () {

    dd(auth()->user()->tokenCan('server:add'));


})->middleware('auth:sanctum');



