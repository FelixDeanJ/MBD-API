<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibitController;
use App\Http\Controllers\KebunController;
use App\Http\Controllers\PembibitanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', function () {
    return csrf_token();
});
Route::post('/bibit', [BibitController::class, 'createBibit']);
Route::get('/bibit', [BibitController::class, 'getBibit']);
Route::get('/bibit/{id}', [BibitController::class, 'getBibitId']);
Route::put('/bibit/{id}', [BibitController::class, 'updatebibit']);
Route::delete('/bibit/{id}', [BibitController::class, 'deleteBibit']);
Route::delete('/bibit/delete-all', [BibitController::class, 'deleteBibitData']);

Route::post('/kebun', [KebunController::class, 'createKebun']);
Route::get('/kebun', [KebunController::class, 'getKebun']);
Route::get('/kebun/{id}', [KebunController::class, 'getKebunID']);
Route::put('/kebun/{id}', [KebunController::class, 'updateKebun']);
Route::delete('/kebun/{id}', [KebunController::class, 'deleteKebun']);
Route::delete('/kebun/delete-all', [BibitController::class, 'deleteAllKebun']);

Route::post('/pembibitan', [PembibitanController::class, 'CreatePembibitan']);
Route::get('/pembibitan', [PembibitanController::class, 'readPembibitan']);
Route::get('/pembibitan/{id}', [PembibitanController::class, 'readPembibitanID']);
Route::put('/pembibitan/{id}', [PembibitanController::class, 'updatePembibitan']);
Route::delete('/pembibitan/{id}', [PembibitanController::class, 'deletePembibitan']);
Route::delete('/pembibitan/delete-all', [BibitController::class, 'deletePembibitanAll']);