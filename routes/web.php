<?php

use App\Http\Livewire\Mytalks;
use App\Http\Livewire\Submission;
use App\Models\BaresipWebrtc;
use App\Models\Page;
use App\Models\Room;
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
    $avatar = '/storage/small/' . $user->profile_photo_path;
    return view('user.card', ['user' => $user, 'avatar' => $avatar]);
})->name('user_card');

Route::get(
    '/page/{page:slug}',
    function (Page $page) {
        return view('page', ['page' => $page]);
    }
);

Route::get('/fahrplan', App\Http\Livewire\Schedule::class)->name('fahrplan');


/* AUTH Routes */
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/merch-sticker', function () {
        return view('merch');
    })->name('merch');

    Route::get('/talks/my', function () {
        return view('talk.myindex');
    })->name('mytalks');

    Route::get('/camping', function () {
        return view('camping.index');
    })->name('camping');

    Route::get(
        '/user/workadventure/login',
        function () {
            return redirect(
                "https://play.wa.podstock.de/podstock/" . auth()->user()->uuid
            );
        }
    );

    Route::post('/webrtc/{room:slug}/sdp', function (Room $room) {
        $room->baresip?->inc_users();
        BaresipWebrtc::sdp($room->baresip?->id, request()->getContent());
    });

    Route::get('/webrtc/{room:slug}/disconnect', function (Room $room) {
        $room->baresip?->dec_users();
        BaresipWebrtc::disconnect($room->baresip?->id);
    });

    Route::get('/room/{room:slug}', App\Http\Livewire\Room\Index::class);
    Route::get('/talks/submission', Submission::class)->name('submission');
    Route::get('/talks/submission/{talk}', Submission::class)->name('submission.edit');
});
