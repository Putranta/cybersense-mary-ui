<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
class extends Component {
    //
}; ?>

<div class="min-h-[100vh] overflow-hidden pb-40 pt-10 px-4 lg:px-8">
    <h1 class="font-title text-center text-[clamp(2rem,8vw,3rem)] font-black leading-none xl:text-center">
        <span class="motion-reduce:!opacity-100" style="opacity:1">Petunjuk Penggunaan</span>
        <br>
        <span
            class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">CyberSense
            UMKM</span>
    </h1>

    <ul class="timeline timeline-vertical pt-10 lg:px-20 pb-10 hidden lg:block">
        <li>
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-start text-right timeline-box">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">1.
                    Registrasi</span> <br>
                Daftar dan Lengkapi Identitas Anda
            </div>
            <hr />
        </li>
        <li>
            <hr />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-end timeline-box">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    2. Lengkapi Profil Bisnis Anda
                </span> <br>
                Isi informasi mengenai bisnis Anda, termasuk jenis industri, skala bisnis, dan jumlah karyawan yang
                menggunakan teknologi.
            </div>
            <hr />
        </li>
        <li>
            <hr />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-start text-right timeline-box">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    3. Masukkan Data Infrastruktur Teknologi
                </span> <br>
                Pada halaman Infrastruktur Teknologi, lengkapi informasi terkait perangkat keras dan perangkat lunak
                yang digunakan. <br>
                Termasuk jenis jaringan, sistem operasi, aplikasi bisnis, dan apakah menggunakan layanan cloud.
            </div>
            <hr />
        </li>
        <li>
            <hr />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-end timeline-box">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    4. Identifikasi Jenis dan Sensitivitas Data
                </span> <br>
                Pada bagian Jenis dan Sensitivitas Data, isikan jenis data pelanggan, keuangan, atau operasional yang
                disimpan.
            </div>
            <hr />
        </li>
        <li>
            <hr />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-start text-right timeline-box">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    5. Tentukan Protokol Keamanan yang Ada
                </span> <br>
                Masuk ke halaman Protokol Keamanan untuk mengisi detail tentang langkah-langkah keamanan yang telah Anda
                terapkan. <br>
                Masukkan informasi seperti penggunaan firewall, enkripsi, autentikasi dua faktor, dan VPN untuk memantau
                akses.
            </div>
            <hr />
        </li>
        <li>
            <hr />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-end timeline-box">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    6. Lengkapi Data Kebijakan Keamanan dan Pelatihan Karyawan
                </span> <br>
                Di halaman Kebijakan Keamanan, isikan kebijakan password, pelatihan keamanan karyawan, dan backup data.
            </div>
            <hr />
        </li>

        <li>
            <hr />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-start text-right timeline-box">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    7. Lihat Hasil Penilaian Risiko
                </span> <br>
                Setelah mengisi semua data yang diperlukan, buka halaman Penilaian Risiko.
                Anda akan melihat laporan lengkap tentang risiko keamanan siber di bisnis Anda, beserta skor dan
                kategorisasi (rendah, sedang, tinggi, atau sangat tinggi).
            </div>
            <hr />
        </li>

        <li>
            <hr />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-end timeline-box">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    8. Terapkan Rekomendasi Keamanan Siber
                </span> <br>
                Berdasarkan hasil penilaian, buka bagian Rekomendasi Keamanan.
                Ikuti panduan yang disarankan untuk memperkuat keamanan, seperti pelatihan tambahan untuk karyawan atau
                penerapan firewall.
            </div>
            <hr />
        </li>

        <li>
            <hr />
            <div class="timeline-middle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="timeline-start text-right timeline-box">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    9. Pantau dan Perbarui Profil Secara Berkala
                </span> <br>
                Keamanan siber memerlukan pemantauan dan peningkatan yang berkelanjutan.
                Kunjungi CyberSense UMKM secara rutin untuk memperbarui profil bisnis dan melakukan penilaian ulang.
                Dengan pemantauan rutin, bisnis Anda akan lebih siap menghadapi ancaman siber.
            </div>
            <hr />
        </li>
    </ul>

    {{-- Petunjuk Mobile --}}
    <ul class="pt-10 lg:px-10 pb-10 lg:hidden">
        <li class="mb-4">
            <div class="timeline-start timeline-box w-full">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">1.
                    Registrasi</span> <br>
                Daftar dan Lengkapi Identitas Anda
            </div>

        </li>
        <li class="mb-4">
            <div class="timeline-end timeline-box w-full">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    2. Lengkapi Profil Bisnis Anda
                </span> <br>
                Isi informasi mengenai bisnis Anda, termasuk jenis industri, skala bisnis, dan jumlah karyawan yang
                menggunakan teknologi.
            </div>
        </li>
        <li class="mb-4">
            <div class="timeline-start timeline-box w-full">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    3. Masukkan Data Infrastruktur Teknologi
                </span> <br>
                Pada halaman Infrastruktur Teknologi, lengkapi informasi terkait perangkat keras dan perangkat lunak
                yang digunakan. <br>
                Termasuk jenis jaringan, sistem operasi, aplikasi bisnis, dan apakah menggunakan layanan cloud.
            </div>

        </li>
        <li class="mb-4">
            <div class="timeline-end timeline-box w-full">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    4. Identifikasi Jenis dan Sensitivitas Data
                </span> <br>
                Pada bagian Jenis dan Sensitivitas Data, isikan jenis data pelanggan, keuangan, atau operasional yang
                disimpan.
            </div>
        </li>
        <li class="mb-4">
            <div class="timeline-start timeline-box w-full">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    5. Tentukan Protokol Keamanan yang Ada
                </span> <br>
                Masuk ke halaman Protokol Keamanan untuk mengisi detail tentang langkah-langkah keamanan yang telah Anda
                terapkan. <br>
                Masukkan informasi seperti penggunaan firewall, enkripsi, autentikasi dua faktor, dan VPN untuk memantau
                akses.
            </div>
        </li>
        <li class="mb-4">
            <div class="timeline-end timeline-box w-full">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    6. Lengkapi Data Kebijakan Keamanan dan Pelatihan Karyawan
                </span> <br>
                Di halaman Kebijakan Keamanan, isikan kebijakan password, pelatihan keamanan karyawan, dan backup data.
            </div>
        </li>

        <li class="mb-4">
            <div class="timeline-start timeline-box w-full">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    7. Lihat Hasil Penilaian Risiko
                </span> <br>
                Setelah mengisi semua data yang diperlukan, buka halaman Penilaian Risiko.
                Anda akan melihat laporan lengkap tentang risiko keamanan siber di bisnis Anda, beserta skor dan
                kategorisasi (rendah, sedang, tinggi, atau sangat tinggi).
            </div>
        </li>

        <li class="mb-4">
            <div class="timeline-end timeline-box w-full">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    8. Terapkan Rekomendasi Keamanan Siber
                </span> <br>
                Berdasarkan hasil penilaian, buka bagian Rekomendasi Keamanan.
                Ikuti panduan yang disarankan untuk memperkuat keamanan, seperti pelatihan tambahan untuk karyawan atau
                penerapan firewall.
            </div>
        </li>

        <li class="mb-4">
            <div class="timeline-start timeline-box w-full">
                <span
                    class="text-[clamp(1.3rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                    9. Pantau dan Perbarui Profil Secara Berkala
                </span> <br>
                Keamanan siber memerlukan pemantauan dan peningkatan yang berkelanjutan.
                Kunjungi CyberSense UMKM secara rutin untuk memperbarui profil bisnis dan melakukan penilaian ulang.
                Dengan pemantauan rutin, bisnis Anda akan lebih siap menghadapi ancaman siber.
            </div>
        </li>
    </ul>

    <div class="timeline-start text-center timeline-box border border-warning">
        <span
            class="text-[clamp(1.5rem,8vw,1rem)] bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">Tips Penting</span> <br>
        <ul>
            <li>
                <strong>Berikan Data yang Akurat</strong> <br>Data yang akurat akan menghasilkan penilaian risiko yang tepat, sehingga saran yang diberikan akan relevan dengan kebutuhan Anda.
            </li>
            <li>
                <strong>Lakukan Penilaian Rutin</strong> <br>Keamanan siber selalu berkembang, jadi disarankan untuk melakukan penilaian setiap 3–6 bulan.
            </li>
            <li>
                <strong>Libatkan Karyawan</strong> <br> Bagikan hasil dan rekomendasi kepada tim Anda untuk meningkatkan kesadaran dan tanggung jawab terhadap keamanan siber.
            </li>
        </ul>
    </div>
</div>

