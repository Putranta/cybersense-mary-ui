<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
class extends Component {
    //
}; ?>

<div class="min-h-[100vh] overflow-hidden pb-40 pt-10 px-8">
    <h1 class="text-5xl font-bold text-center">
        <span class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
            Pengembang
        </span>
    </h1>
    <p class="text-center mt-8">
        Website ini dibuat sebagai Projek Akhir Mata Kuliah Sistem Pakar Fakultas Informatika Universitas Janabadra 2024
    </p>

    <!-- Card Dosen -->
    <div class="flex justify-center mb-12 mt-10">
        <div class="card bg-base-100 shadow-lg rounded-lg pt-6 hover:shadow-xl transition-shadow duration-300">
            <figure class="flex justify-center mb-4">
                <img src="{{ asset('bu marlin.jpeg') }}" alt="Foto Dosen"
                    class="rounded-full w-32 h-32 border-4 border-indigo-500">
            </figure>
            <div class="card-body text-center">
                <h2 class="text-xl font-semibold">Yumarlin MZ, S.Kom., M.Pd., M.Kom.</h2>
            </div>
        </div>
    </div>

    <!-- Kartu Mahasiswa -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 px-4">
        <!-- Mahasiswa 1 -->
        <div
            class="card w-full bg-base-100 shadow-xl rounded-lg pt-6 mx-auto hover:shadow-lg transition-shadow duration-300">
            <figure class="flex justify-center mb-4">
                <img src="{{ asset('putra.jpg') }}" alt="Foto Mahasiswa"
                    class="rounded-full w-32 h-32 border-4 border-blue-400">
            </figure>
            <div class="card-body text-center">
                <h2 class="text-lg font-semibold">Putranta Aswintama</h2>
                <p class="text-gray-500">NIM: 21330001</p>
            </div>
        </div>

        <!-- Mahasiswa 2 -->
        <div
            class="card w-full bg-base-100 shadow-xl rounded-lg pt-6 mx-auto hover:shadow-lg transition-shadow duration-300">
            <figure class="flex justify-center mb-4">
                <img src="{{ asset('image.png') }}" alt="Foto Mahasiswa"
                    class="rounded-full w-32 h-32 border-4 border-green-400">
            </figure>
            <div class="card-body text-center">
                <h2 class="text-lg font-semibold">Ridwan</h2>
                <p class="text-gray-500">NIM: 21330040</p>
            </div>
        </div>

        <!-- Mahasiswa 3 -->
        <div
            class="card w-full bg-base-100 shadow-xl rounded-lg pt-6 mx-auto hover:shadow-lg transition-shadow duration-300">
            <figure class="flex justify-center mb-4">
                <img src="{{ asset('foto reihan.jpg') }}" alt="Foto Mahasiswa"
                    class="rounded-full w-32 h-32 border-4 border-red-400 object-cover">
            </figure>
            <div class="card-body text-center">
                <h2 class="text-lg font-semibold">Reihan Nanda Muliawan</h2>
                <p class="text-gray-500">NIM: 20330014</p>
            </div>
        </div>

        <!-- Mahasiswa 4 -->
        <div
            class="card w-full bg-base-100 shadow-xl rounded-lg pt-6 mx-auto hover:shadow-lg transition-shadow duration-300">
            <figure class="flex justify-center mb-4">
                <img src="{{ asset('parman.jpg') }}" alt="Foto Mahasiswa"
                    class="rounded-full w-32 h-32 border-4 border-yellow-400 object-cover">
            </figure>
            <div class="card-body text-center">
                <h2 class="text-lg font-semibold">Arianto Parman Sermae</h2>
                <p class="text-gray-500">NIM: 21330018</p>
            </div>
        </div>
    </div>
</div>

