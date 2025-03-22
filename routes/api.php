<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/standards', function (\Illuminate\Http\Request $request) {
    $type = $request->input('type');
    if ($type === 'App\Models\MainStandard') {
        return \App\Models\MainStandard::all(['id', 'name_ar', 'name_en']);
    } elseif ($type === 'App\Models\SubStandard') {
        return \App\Models\SubStandard::all(['id', 'name_ar', 'name_en']);
    }
    return [];
});