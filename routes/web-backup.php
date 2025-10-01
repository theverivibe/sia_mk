<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Assets\Index as AssetsIndex;
use App\Livewire\Complaints\Index as ComplaintsIndex;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    
    // Assets Routes
    Route::get('assets', \App\Livewire\Assets\AssetList::class)->name('assets.index');
    Route::get('assets/create', \App\Livewire\Assets\AssetForm::class)->name('assets.create')->middleware('role:staff_it');
    Route::get('assets/{asset}', \App\Livewire\Assets\AssetDetail::class)->name('assets.show');
    Route::get('assets/{asset}/edit', \App\Livewire\Assets\AssetForm::class)->name('assets.edit')->middleware('role:staff_it');
    
    Route::get('complaints', ComplaintsIndex::class)->name('complaints.index');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
