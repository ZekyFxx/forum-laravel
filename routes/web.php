<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ShowThreads;
use App\Livewire\ShowThread;
use App\Http\Controllers\ThreadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', ShowThreads::class)
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/thread/{thread}', ShowThread::class)
    ->middleware(['auth'])
    ->name('thread');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('threads', ThreadController::class)->except(['show','index','destroy'])
    ->middleware(['auth']);

require __DIR__.'/auth.php';