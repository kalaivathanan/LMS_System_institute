<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fetch-pending-records', [App\Http\Controllers\rfidcontroller::class, 'fetchPendingRecordsForEsp32']);
Route::post('/store-rfid', 'App\Http\Controllers\rfidcontroller@storeRFID');
Route::post('/markattendence', 'App\Http\Controllers\rfidcontroller@markAttendence');
