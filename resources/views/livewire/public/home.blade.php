<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
class extends Component {
    //
}; ?>

<div>
    <div class="min-h-[100vh] overflow-hidden pb-40 pt-32">
        <div class="relative">
            <div
                class="relative flex flex-col items-center justify-center gap-10 px-4 md:px-10 xl:flex-row-reverse xl:gap-0">
                <div>
                    <div
                        class="bg-primary pointer-events-none absolute start-20 aspect-square w-96 rounded-full opacity-20 blur-3xl [transform:translate3d(0,0,0)]">
                    </div>
                    <div
                        class="bg-success pointer-events-none absolute aspect-square w-full rounded-full opacity-10 blur-3xl [transform:translate3d(0,0,0)]">
                    </div>
                    <h2 class="font-title text-center text-[clamp(2rem,8vw,3rem)] font-black leading-none xl:text-start">
                        <span class="motion-reduce:!opacity-100" style="opacity:1">Selamat Datang di</span>
                        <br>
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">CyberSense
                            UMKM</span>
                    </h2>
                    <div class="h-10"></div>
                    <p class="text-base-content/70 font-title text-center font-light md:text-2xl xl:text-start">Jaga
                        keamanan bisnis Anda bersama kami, karena keamanan adalah investasi terbaik</p>
                    <div class="h-10"></div>
                    <div class="flex w-full justify-center xl:justify-start">
                        <a data-sveltekit-preload-data href="{{ url('/cek-risiko') }}" wire:navigate
                            class="btn btn-md btn-primary btn-wide group">Cek Risiko <svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="hidden h-6 w-6 transition-transform duration-300 group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1 md:inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                            </svg></a>
                    </div>
                </div>
                <div class="grid shrink-0 gap-0 xl:grid-cols-5">
                    <div class="card border-base-content/10 col-span-4 col-start-1 row-start-1 flex flex-col  will-change-auto motion-reduce:!transform-none"
                        style="transform:translateX(0%)">
                        <div class="card-body">
                            <img src="{{ asset('cyber sense 2.png') }}" alt="" width="450px">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End Hero --}}

    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse lg:gap-20">
            <img src="{{ asset('cyber sense 3.png') }}" class="max-w-md hidden lg:block" width="400px" />
            <div>
                <h1 class="text-5xl font-bold">Kenapa CyberSense UMKM?</h1>
                <p class="py-6">
                    <span
                        class="text-[clamp(2rem,8vw,2rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500  to-cyan-500">CyberSense
                        UMKM</span> adalah solusi cerdas untuk membantu usaha kecil dan menengah menilai, memahami, dan
                    meningkatkan keamanan siber UMKM. Di era digital yang penuh dengan ancaman, kami hadir untuk
                    mendukung UMKM agar tetap aman dari serangan siber dan menjaga data berharga pelanggan dengan
                    langkah-langkah yang mudah diterapkan.
                </p>
                <button class="btn btn-primary">Cek Risiko</button>
            </div>
        </div>
    </div>

    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col lg:flex-row lg:gap-20">
            <img src="{{ asset('cyber sense 3.png') }}" class="max-w-md hidden lg:block" width="400px" />
            <div>
                <h1 class="text-5xl font-bold mb-4">Fitur Utama CyberSense UMKM</h1>
                <ul class="timeline timeline-vertical hidden lg:flex">
                    <li>
                        <div class="timeline-middle">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-5 w-5">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="timeline-start timeline-box">
                            <span
                                class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500  to-cyan-500">Penilaian
                                Risiko Keamanan</span> <br>
                            Dapatkan gambaran lengkap tentang tingkat risiko keamanan bisnis Anda dalam beberapa langkah
                            mudah.
                        </div>
                        <hr />
                    </li>
                    <li>
                        <hr />
                        <div class="timeline-middle">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-5 w-5">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="timeline-end timeline-box">
                            <span
                                class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500  to-cyan-500">Rekomendasi
                                Keamanan</span> <br>
                            Berdasarkan hasil penilaian, kami menyediakan rekomendasi praktis yang sesuai dengan skala
                            bisnis dan anggaran Anda.
                        </div>
                        <hr />
                    </li>
                    <li>
                        <hr />
                        <div class="timeline-middle">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-5 w-5">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="timeline-start timeline-box">
                            <span
                                class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500  to-cyan-500">Panduan
                                Pelatihan Keamanan untuk Karyawan</span> <br>
                            Tingkatkan kesadaran dan keterampilan keamanan siber bagi karyawan Anda melalui panduan dan
                            pelatihan yang mudah diakses.
                        </div>
                        <hr />
                    </li>
                </ul>

                {{-- Fitur Mobile --}}
                <ul class="lg:hidden">
                    <li class="mb-4 w-full">
                        <div class="timeline-start timeline-box w-full">
                            <span
                                class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500  to-cyan-500">Penilaian
                                Risiko Keamanan</span> <br>
                            Dapatkan gambaran lengkap tentang tingkat risiko keamanan bisnis Anda dalam beberapa langkah
                            mudah.
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="timeline-end timeline-box w-full">
                            <span
                                class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500  to-cyan-500">Rekomendasi
                                Keamanan</span> <br>
                            Berdasarkan hasil penilaian, kami menyediakan rekomendasi praktis yang sesuai dengan skala
                            bisnis dan anggaran Anda.
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="timeline-start timeline-box w-full">
                            <span
                                class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500  to-cyan-500">Panduan
                                Pelatihan Keamanan untuk Karyawan</span> <br>
                            Tingkatkan kesadaran dan keterampilan keamanan siber bagi karyawan Anda melalui panduan dan
                            pelatihan yang mudah diakses.
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="min-h-[100vh] overflow-hidden pb-40 pt-32">
        <div class="relative">
            <div
                class="relative flex flex-col items-center justify-center gap-10 px-4 md:px-10 xl:flex-row-reverse xl:gap-0">
                <div>
                    <div
                        class="bg-primary pointer-events-none absolute start-20 aspect-square w-96 rounded-full opacity-20 blur-3xl [transform:translate3d(0,0,0)]">
                    </div>
                    <div
                        class="bg-success pointer-events-none absolute aspect-square w-full rounded-full opacity-10 blur-3xl [transform:translate3d(0,0,0)]">
                    </div>
                    <h2
                        class="font-title text-center text-[clamp(2rem,8vw,3rem)] font-black leading-none xl:text-center">
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500  to-cyan-500">CyberSense
                            UMKM</span> <br>
                        <span class="motion-reduce:!opacity-100" style="opacity:1">Perlindungan Mudah dan Terjangkau
                            <br> untuk Bisnis Anda</span>
                        <br>
                    </h2>
                    <div class="h-10"></div>
                    <p class="text-base-content/70 font-title text-center font-light md:text-2xl xl:text-center">
                        Tidak perlu menjadi ahli siber untuk melindungi bisnis Anda. Dengan CyberSense UMKM, Anda bisa
                        langsung memahami potensi risiko dan mengambil tindakan preventif yang akan menjaga bisnis Anda
                        tetap aman dari ancaman digital.
                    </p>
                    <div class="h-10"></div>
                    <div class="flex w-full justify-center xl:justify-center">
                        <a data-sveltekit-preload-data href="{{ url('/cek-risiko') }}" wire:navigate
                            class="btn btn-md btn-primary btn-wide group">Cek Risiko <svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="hidden h-6 w-6 transition-transform duration-300 group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1 md:inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                            </svg></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

