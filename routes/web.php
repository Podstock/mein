<?php

use App\Http\Livewire\Mytalks;
use App\Http\Livewire\Submission;
use App\Models\User;
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

Route::get('/', function () {
    return redirect(route('mytalks'));
});

Route::get('/user/card/{user}', function (User $user) {
    $avatar = '/storage/tiny/'.$user->profile_photo_path;
    return view('user.card', ['user' => $user, 'avatar' => $avatar]);
})->name('user_card');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/talks/my', function () {
        return view('talk.myindex');
    })->name('mytalks');

    Route::get(
        '/user/workadventure/login',
        function () {
            return redirect(
                "https://play.wa.podstock.de/podstock/" . auth()->user()->uuid
            );
        }
    );

    Route::get('/talks/submission', Submission::class)->name('submission');
    Route::get('/talks/submission/{talk}', Submission::class)->name('submission.edit');
});
