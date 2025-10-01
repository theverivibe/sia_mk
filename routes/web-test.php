<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Assets\AssetList;
use App\Livewire\Complaints\Index as ComplaintsIndex;

Route::view('/', 'welcome');

// Test route untuk debug dashboard
Route::get('/test-dashboard', function () {
    $user = \App\Models\User::where('role', 'staff_it')->first();
    \Illuminate\Support\Facades\Auth::login($user);
    
    $stats = [
        'total_assets' => \App\Models\Asset::count(),
        'available_assets' => \App\Models\Asset::where('status', 'tersedia')->count(),
        'in_use_assets' => \App\Models\Asset::where('status', 'digunakan')->count(),
        'total_complaints' => \App\Models\Complaint::count(),
        'new_complaints' => \App\Models\Complaint::where('status', 'baru')->count(),
        'resolved_complaints' => \App\Models\Complaint::where('status', 'selesai')->count(),
    ];
    
    return view('test-dashboard', [
        'user' => $user,
        'stats' => $stats
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    
    // Assets Routes
    Route::get('assets', AssetList::class)->name('assets.index');
    Route::get('assets/create', \App\Livewire\Assets\AssetForm::class)->name('assets.create')->middleware('role:staff_it');
    Route::get('assets/{asset}', \App\Livewire\Assets\AssetDetail::class)->name('assets.show');
    Route::get('assets/{asset}/edit', \App\Livewire\Assets\AssetForm::class)->name('assets.edit')->middleware('role:staff_it');
    
    Route::get('complaints', ComplaintsIndex::class)->name('complaints.index');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';