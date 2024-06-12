<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define routes with the specified route prefix
Route::prefix('/v1')->group(function () {
    // Include other routes from the V1 folder
    foreach (glob(__DIR__.'/V1/*.php') as $file) {
        require $file;
    }
});