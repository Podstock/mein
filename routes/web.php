<?php

use App\Http\Livewire\Mytalks;
use App\Http\Livewire\Submission;
use App\Models\BaresipWebrtc;
use App\Models\Page;
use App\Models\Room;
use App\Models\Tent;
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
    return redirect(route('dashboard'));
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

    Route::post('/webrtc/{room_slug}/sdp', function ($room_slug) {
        BaresipWebrtc::sdp($room_slug, request()->getContent(), false);
    });

    Route::post('/webrtc_video/{room_slug}/sdp', function ($room_slug) {
        BaresipWebrtc::sdp($room_slug, request()->getContent(), true, false);
    });

    Route::post('/webrtc_video/{room_slug}/sdp/cam', function ($room_slug) {
        BaresipWebrtc::sdp($room_slug, request()->getContent(), true, true);
    });

    Route::get('/webrtc/{room_slug}/disconnect', function ($room_slug) {
        BaresipWebrtc::disconnect($room_slug, 'audio');
    });

    Route::get('/webrtc_video/{room_slug}/disconnect', function ($room_slug) {
        BaresipWebrtc::disconnect($room_slug, 'video');
    });

    Route::get('/camping/{tent:number}', function (Tent $tent) {
        return view('tent', ['tent' => $tent]);
    });

    Route::get('/room/{room:slug}', App\Http\Livewire\Room\Index::class);
    Route::get('/talks/submission', Submission::class)->name('submission');
    Route::get('/talks/submission/{talk}', Submission::class)->name('submission.edit');
});
