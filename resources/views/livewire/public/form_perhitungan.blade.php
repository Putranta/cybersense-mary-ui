<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\LogPengguna;
use App\Models\Kriteria;
use App\Models\InputPengguna;
use App\Models\RuleBase;

new
#[Layout('components.layouts.public')]
class extends Component {
    public LogPengguna $pengguna;
    public array $selectedOptions = []; // Array pilihan user
    public $similarityResults = [];
    public $highestSimilarity;
    public bool $hasil = false;
    public $inputan;
    public $dataInput;

    public function mount($id)
    {
        $this->pengguna = LogPengguna::findOrFail($id);

        if ($this->pengguna->inputs->count() > 0) {
            $this->hasil = true;

            $this->similarityResults = $this->calculateSimilarity($this->pengguna->id);
            $this->highestSimilarity = collect($this->similarityResults)
                ->sortByDesc('similarity')
                ->first();
            $this->inputan = InputPengguna::where('log_pengguna_id', $id)
                ->with('kriteriaDetail.kriteria') // Load semua relasi yang dibutuhkan
                ->get();
        }
    }

    public function with(): array
    {
        return [
            'kriteria' => Kriteria::with('kriteriaDetails')->get(), // Ambil semua kriteria dengan relasi
        ];
    }

    public function findMatchingRules($logPenggunaId)
    {
        // Ambil kriteria_detail_id dari input_pengguna
        $userDetails = InputPengguna::where('log_pengguna_id', $logPenggunaId)->pluck('kriteria_detail_id')->toArray();

        // Cari rule_base dengan kriteria_detail_id yang cocok
        $matchingRules = RuleBase::whereHas('ruleOrders', function ($query) use ($userDetails) {
            $query->whereIn('kriteria_detail_id', $userDetails);
        })->get();

        return $matchingRules;
    }

    public function calculateSimilarity($logPenggunaId)
    {
        $userDetails = InputPengguna::where('log_pengguna_id', $logPenggunaId)->pluck('kriteria_detail_id')->toArray();

        if (empty($userDetails)) {
            return []; // Tidak ada input pengguna
        }

        $ruleBases = RuleBase::with('ruleOrders.kriteriaDetail.kriteria')->get();
        $similarityScores = [];

        foreach ($ruleBases as $ruleBase) {
            $numerator = 0;
            $denominator = 0;

            foreach ($ruleBase->ruleOrders as $ruleOrder) {
                $detail = $ruleOrder->kriteriaDetail;

                if (!$detail || !$detail->kriteria) {
                    continue; // Lewati jika relasi tidak valid
                }

                $bobot = $detail->kriteria->bobot ?? 0;
                $denominator += $bobot;

                if (in_array($detail->id, $userDetails)) {
                    $numerator += 1 * $bobot; // Hitung kecocokan
                }
            }

            $denominator = max($denominator, 1); // Hindari pembagian dengan nol
            $similarity = $numerator / $denominator;

            $similarityScores[] = [
                'rule_base' => $ruleBase,
                'similarity' => $similarity,
            ];
        }

        usort($similarityScores, function ($a, $b) {
            return ($b['similarity'] ?? 0) <=> ($a['similarity'] ?? 0);
        });

        return $similarityScores;
    }

    public function calculate(): void
    {
        // Simpan data ke input_pengguna
        foreach ($this->selectedOptions as $kriteriaId => $kriteriaDetailId) {
            InputPengguna::create([
                'log_pengguna_id' => $this->pengguna->id,
                'kriteria_detail_id' => $kriteriaDetailId,
                '',
            ]);
        }

        // $matchingRules = $this->findMatchingRules($this->pengguna->id);

        // Hitung similarity
        $this->similarityResults = $this->calculateSimilarity($this->pengguna->id);

        // Ambil similarity dengan skor tertinggi
        $this->highestSimilarity = collect($this->similarityResults)
            ->sortByDesc('similarity')
            ->first();
        $this->inputan = InputPengguna::where('log_pengguna_id', $this->pengguna->id)
            ->with('kriteriaDetail.kriteria')->get();

        $this->hasil = true;
    }
}; ?>

<div class="mb-8">

    @if (!$hasil)
        <div class="md:w-2/3 mx-auto mt-10">
            <x-card title="Form Perhitungan" subtitle="Pilih Sesuai dengan kondisi UMKM kamu sekarang" shadow separator>
                <x-form wire:submit="calculate">
                    @foreach ($kriteria as $item)
                        <x-card title="{{ $item['name'] }}">

                            <x-radio :options="$item['kriteriaDetails']" wire:model="selectedOptions.{{ $item['id'] }}" />

                            <div class="flex flex-row gap-3 mt-3">
                                @foreach ($item['kriteriaDetails'] as $detail)
                                    @if ($detail['desc'] != null)
                                        <div class="bg-base-200 p-2 rounded">
                                            <strong>{{ $detail['name'] }}</strong>
                                            <p>{{ $detail['desc'] }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </x-card>
                        <hr>
                    @endforeach
                    <x-slot:actions>
                        {{-- <x-button label="Already registered?" class="btn-ghost" link="/login" /> --}}
                        <x-button label="Analyze" type="submit" icon="o-paper-airplane" class="btn-primary"
                            spinner="calculate" />
                    </x-slot:actions>
                </x-form>
            </x-card>
        </div>
    @else
        <div class="md:w-1/2 mx-auto mt-10">
            @if (!empty($pengguna))
                <x-card title="Detail Pengguna" separator shadow class="shadow-lg">
                    <div class="flex flex-row gap-3">
                        <div class="basis-1/2">
                            <x-input label="Nama" value="{{ $pengguna->name }}" readonly inline class="mb-3" />
                            <x-input label="Nama UMKM" value="{{ $pengguna->umkm_name }}" readonly inline
                                class="mb-3" />
                        </div>
                        <div class="basis-1/2">
                            <x-input label="No HP/Email" value="{{ $pengguna->no_hp }}" readonly inline
                                class="mb-3" />
                            <x-input label="Alamat" value="{{ $pengguna->provinsi . ', ' . $pengguna->kabupaten }}"
                                readonly inline class="mb-3" />
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
                        <div class="radial-progress mb-5
                            {{ $highestSimilarity['rule_base']->kategori == 'Rendah' ? 'text-success'
                            : ($highestSimilarity['rule_base']->kategori == 'Sedang' ? 'text-warning'
                            : ($highestSimilarity['rule_base']->kategori == 'Tinggi'  ? 'text-accent'
                            : 'text-red-600')) }}"
                            style="--value:{{ floatval($highestSimilarity['rule_base']->skor) * 2 }}; --size:12rem; --thickness: 6px;"
                            role="progressbar">
                            {{ floatval($highestSimilarity['rule_base']->skor) * 2 }}
                        </div>

                        <h3 class="font-title text-center text-[clamp(1rem,8vw,2.5rem)] font-black leading-none ">Kategori
                            Resiko: {{ $highestSimilarity['rule_base']->kategori }}</h3>
                    </div>

                    <div class="text-center mb-5">
                        @php
                            $nilai = floatval($highestSimilarity['similarity']) * 100;
                        @endphp
                        <p>
                            <strong>Keterangan :</strong> <br>
                            Case yang mirip dengan inputan Anda adalah Case Milik
                            <strong>{{ $highestSimilarity['rule_base']->pemilik_case }}</strong> dengan Kemiripan
                            <strong>{{ number_format($nilai, 2) }}%</strong>
                        </p>
                    </div>

                    <x-card class="border border-primary">
                        <h3 class="font-title mb-3 text-center text-[clamp(0.75rem,6vw,2rem)] font-black leading-none ">
                            Rekomendasi Keamanan</h3>
                        <div class="prose">
                            <ul>
                                @foreach ($inputan as $item)
                                    @if ($item->kriteriaDetail->rekomendasi != null)
                                        <li>{{ $item->kriteriaDetail->rekomendasi }}</li>
                                    @endif
                                 @endforeach
                            </ul>
                        </div>
                    </x-card>
                @else
                    <p class="text-center">Data similarity tidak ditemukan.</p>
                @endif
            </x-card>
        </div>

    @endif
</div>
