<?php

use App\Http\Controllers\api\v1\CifController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\DebitursController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/v1/debiturs', [DebitursController::class, 'index']);
Route::post('/v1/debiturs/store', [DebitursController::class, 'store']);
Route::post('/v1/debiturs/update', [DebitursController::class, 'update']);
Route::delete('/v1/debiturs/{id}', [DebitursController::class, 'destroy']);

Route::get('/v1/cif', [CifController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
