<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'public.home')->name('landing');
Volt::route('/cek-risiko', 'public.cekresiko')->name('cek');
Volt::route('/form/user/{id}', 'public.form_perhitungan')->name('form');
Volt::route('/hasil', 'public.hasil')->name('hasil');
Volt::route('/petunjuk', 'public.petunjuk')->name('petunjuk');
Volt::route('/pengembang', 'public.pengembang')->name('pengembang');

// Users will be redirected to this route if not logged in
Volt::route('/login', 'auth.login')->name('login');
Volt::route('/register', 'auth.register');

// Define the logout
Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
});

// Protected routes here
Route::middleware('auth')->group(function () {
    Volt::route('/users', 'users.index');
    Volt::route('/log-pengguna', 'admin.log_pengguna');
    Volt::route('/dashboard', 'admin.dashboard');
    Volt::route('/kriteria', 'admin.kriteria.index');
    Volt::route('/kriteria/{id}/detail', 'admin.kriteria.detail');
    Volt::route('/rule-base', 'admin.rulebase.index');
    Volt::route('/solusi', 'admin.solusi.index');
    Volt::route('/solusi/create', 'admin.solusi.create');
    Volt::route('/solusi/{id}/edit', 'admin.solusi.edit');
    // ... more
});
