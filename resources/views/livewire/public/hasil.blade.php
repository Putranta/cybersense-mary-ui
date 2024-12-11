<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new
#[Layout('components.layouts.public')]
class extends Component {
    public array $highestSimilarity = [];

    public function mount()
    {
        $this->highestSimilarity = session('highestSimilarity', []);
    }
}; ?>

<div class="flex justify-center items-center">
    <div class="md:w-1/2 mx-auto mt-10">
        <x-card title="Hasil Analisa" separator >
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

