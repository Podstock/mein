<?php

use App\Http\Livewire\Mytalks;
use App\Http\Livewire\Submission;
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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/talks/my', function () {
        return view('talk.myindex');
    })->name('mytalks');

    // Route::get('/talks/my', Mytalks::class)->name('mytalks');

    Route::get('/talks/submission', Submission::class)->name('submission');
    Route::get('/talks/submission/{talk}', Submission::class)->name('submission.edit');
});
