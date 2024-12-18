<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\LogPengguna;
use App\Models\InputPengguna;

new
#[Layout('components.layouts.public')]
class extends Component {
    public array $highestSimilarity = [];
    public LogPengguna $pengguna;
    public $pengguna_id;
    public $inputan;

    public function mount()
    {
        $this->pengguna_id = session('pengguna_id');
        if (!$this->pengguna_id) {
            abort(404, 'Pengguna tidak ditemukan.');
        }
        $this->highestSimilarity = session('highestSimilarity', []);

        $this->pengguna = LogPengguna::findOrFail($this->pengguna_id);
        $this->inputan = InputPengguna::where('log_pengguna_id', $this->pengguna_id)->get();
    }
}; ?>

<div class="flex justify-center items-center">
    <div class="md:w-1/2 mx-auto mt-10">
        @if (!empty($pengguna))
            <x-card title="Detail Pengguna" separator shadow class="shadow-lg">
                <div class="flex flex-row gap-3">
                    <div class="basis-1/2">
                        <x-input label="Nama" value="{{ $pengguna->name}}" readonly inline class="mb-3" />
                        <x-input label="Nama UMKM" value="{{ $pengguna->umkm_name}}" readonly inline class="mb-3" />
                    </div>
                    <div class="basis-1/2">
                        <x-input label="No HP/Email" value="{{ $pengguna->no_hp}}" readonly inline class="mb-3" />
                        <x-input label="Alamat" value="{{ $pengguna->provinsi.', '.$pengguna->kabupaten}}" readonly inline class="mb-3" />
                    </div>
                </div>
            </x-card>
        @endif

        @if (!empty($inputan))
            <x-card title="Detail Inputan" separator shadow class="shadow-lg">
                @if ($inputan->isNotEmpty())
                    @foreach ($inputan as $item)
                        <x-list-item :item="$item" no-separator no-hover>
                            <x-slot:value>
                                {{ $item->kriteriaDetail->kriteria->name }}
                            </x-slot:value>
                            <x-slot:sub-value>
                                {{ $item->kriteriaDetail->name }}
                            </x-slot:sub-value>
                        </x-list-item>
                    @endforeach
                @endif
            </x-card>
         @endif

        <x-card title="Hasil Analisa" separator shadow class="shadow-lg">
            @if (!empty($highestSimilarity))
                <div class="flex flex-col items-center mb-5">
                    <div
                        class="radial-progress mb-3  {{
                            $highestSimilarity['rule_base']->kategori == 'Rendah' ? 'text-success' : (
                            $highestSimilarity['rule_base']->kategori == 'Sedang' ? 'text-warning' : (
                            $highestSimilarity['rule_base']->kategori == 'Tinggi' ? 'text-accent' : 'text-danger'
                        )) }}"
                        style="--value:{{ floatval($highestSimilarity['rule_base']->skor) * 2 }}; --size:12rem; --thickness: 6px;"
                        role="progressbar">
                        {{ floatval($highestSimilarity['rule_base']->skor) * 2 }}
                    </div>

                    <h3 class="font-title text-center text-[clamp(1rem,8vw,3rem)] font-black leading-none ">Kategori Resiko: {{ $highestSimilarity['rule_base']->kategori }}</h3>
                </div>

                <div class="text-center mb-3">
                    @php
                        $nilai = floatval($highestSimilarity['similarity'])*100;
                    @endphp
                    <p>
                        <strong>Keterangan :</strong> <br>
                        Case yang mirip dengan inputan Anda adalah Case Milik <strong>{{ $highestSimilarity['rule_base']->pemilik_case }}</strong> dengan Kemiripan <strong>{{ number_format($nilai, 2)}}%</strong>
                    </p>
                </div>

                <x-card class="border border-primary">
                    <h3 class="font-title mb-3 text-center text-[clamp(0.75rem,6vw,2rem)] font-black leading-none ">Rekomendasi Keamanan</h3>
                    @foreach ($highestSimilarity['rule_base']->kriteriaDetails as $item)
                        {{ $item->rekomendasi }} <br>
                    @endforeach
                </x-card>
            @else
                <p class="text-center">Data similarity tidak ditemukan.</p>
            @endif
        </x-card>
    </div>
</div>

