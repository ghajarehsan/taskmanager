<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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

});


