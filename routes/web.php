<?php

use App\Http\Controllers\PropertyController;
use App\Nova\Property as PropertyResource;
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

Route::get('/property', [PropertyController::class, "Index"]);
Route::get('/appartement', [PropertyController::class, "All"]);
Route::get('/appartement/{id}', [PropertyController::class, 'Get']);
// Route::get('nova', [PropertyResource::class, 'fields']);
