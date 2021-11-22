<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [RestController::class,'list'])->name('list');
Route::get('/products/{code}', [RestController::class,'show'])->name('show');
Route::post('/products', [RestController::class,'create'])->name('create');
Route::put('/products/{code}', [RestController::class,'update'])->name('update');
Route::delete('/products/{code}', [RestController::class,'delete'])->name('delete');
