<?php

use Livewire\Volt\Volt;

Volt::route('/', 'public.home')->name('landing');
Volt::route('/users', 'users.index')->name('users');
Volt::route('/cek-resiko', 'public.cekresiko')->name('cek');
Volt::route('/petunjuk', 'public.petunjuk')->name('petunjuk');
Volt::route('/pengembang', 'public.pengembang')->name('pengembang');
