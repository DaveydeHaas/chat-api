<?php

use App\Http\Controllers\V1\ChatroomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/chatrooms', [ChatroomController::class, 'index']);
    Route::get('/getChatroomById/{id}', [ChatroomController::class, 'getChatroomById']);
    Route::post('/joinChatroomById/{id}',[ChatroomController::class, 'joinChatroomById']);
    Route::post('/sendMessage', [ChatroomController::class, 'saveMessage']);
    
});