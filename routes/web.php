<?php

use App\Livewire\RoulettePage;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('/roulette', RoulettePage::class)->name('roulette');
    // Страница выбора режима заставок
    Route::get('/roulette/stakes', StakesModeSelector::class)->name('stakes.mode');

// Заглушка тренировки (пока)
    Route::get('/roulette/stakes/training', function () {
        $mode = session('stakes_mode', '1-2');
        return view('stakes.training', compact('mode'));
    })->name('stakes.training');


    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
