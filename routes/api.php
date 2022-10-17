<?php

use App\Events\MyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', function (Request $rq) {
    event(new App\Events\loginqr($rq->user,$rq->ip));
});

Route::post('/scaner', function (Request $rq) {
    error_log($rq);
    event(new App\Events\onScaner($rq->ip));
});
