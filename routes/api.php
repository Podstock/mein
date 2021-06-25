<?php

use App\Models\User;
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

Route::get('/user/uuid/{uuid}', function ($uuid) {
    $user = User::where('uuid', $uuid)->firstOrFail();
    return ['username' => $user->nickname, 'uuid' => $user->uuid];
});

Route::get('/user/card_url/{uuid}', function ($uuid) {
    $user = User::where('uuid', $uuid)->firstOrFail();
    return route('user_card', $user->id);
});
