<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Assets\Index as AssetsIndex;
use App\Livewire\Complaints\Index as ComplaintsIndex;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('assets', AssetsIndex::class)->name('assets.index');
    Route::get('complaints', ComplaintsIndex::class)->name('complaints.index');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
