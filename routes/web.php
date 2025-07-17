<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\ClientList;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
Route::redirect('/', '/agent');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', ClientList::class)->name('home');
    Route::get('clients', ClientList::class)->name('clients');
    Route::redirect('settings', 'settings/profile');
    Route::redirect('dashboard', 'agent') ->name('dashboard');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
