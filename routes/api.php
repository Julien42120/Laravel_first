<?php

use App\Http\Controllers\PropertyController;
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

Route::middleware('auth:sanctum')->get('/appartement', function (Request $request) {
    return $request->all();
});

Route::get('/appartement', [PropertyController::class, "All"]);
// Route::get('/appartement/{id}', [PropertyController::class, "Get"]);
Route::get('/appartement/{id}', [PropertyController::class, "show"]);
Route::put('/appartement/modify/{id}', [PropertyController::class, "modify"]);
Route::post('/appartement/add', [PropertyController::class, "add"]);
Route::delete('/appartement/delete/{id}', [PropertyController::class, "delete"]);
