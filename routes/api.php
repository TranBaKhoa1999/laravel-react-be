<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return printJson($request->user(), buildStatusObject('HTTP_OK'), $request->lang);
});

Route::prefix('v1')->group(base_path('routes/api_v1.php'));

require __DIR__.'/auth.php';
