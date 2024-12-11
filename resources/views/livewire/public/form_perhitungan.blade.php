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


    public function mount($id)
    {
        $this->pengguna = LogPengguna::findOrFail($id);
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
        $userDetails = InputPengguna::where('log_pengguna_id', $logPenggunaId)
            ->pluck('kriteria_detail_id')
            ->toArray();

        // Cari rule_base dengan kriteria_detail_id yang cocok
        $matchingRules = RuleBase::whereHas('ruleOrders', function ($query) use ($userDetails) {
            $query->whereIn('kriteria_detail_id', $userDetails);
        })->get();

        return $matchingRules;
    }

    public function calculateSimilarity($logPenggunaId)
    {
        $userDetails = InputPengguna::where('log_pengguna_id', $logPenggunaId)
            ->pluck('kriteria_detail_id')
            ->toArray();

        $ruleBases = RuleBase::with('ruleOrders.kriteriaDetail.kriteria')->get();
        $similarityScores = [];

        foreach ($ruleBases as $ruleBase) {
            $numerator = 0;
            $denominator = 0;

            foreach ($ruleBase->ruleOrders as $ruleOrder) {
                $detail = $ruleOrder->kriteriaDetail;

                // Ambil bobot dari kriteria terkait
                $bobot = $detail->kriteria->bobot ?? 0;

                // Tambahkan ke penyebut
                $denominator += $bobot;

                // Jika kriteria_detail_id cocok dengan input pengguna, hitung pembilang
                if (in_array($detail->id, $userDetails)) {
                    $numerator += 1 * $bobot; // 1 adalah nilai kecocokan
                }
            }

            // Hitung similarity untuk rule_base ini
            $similarity = $denominator > 0 ? $numerator / $denominator : 0;

            $similarityScores[] = [
                'rule_base' => $ruleBase,
                'similarity' => $similarity,
            ];
        }

        // Urutkan berdasarkan similarity tertinggi
        usort($similarityScores, fn($a, $b) => $b['similarity'] <=> $a['similarity']);

        return $similarityScores;
    }

    public function calculate(): void
    {
        // Simpan data ke input_pengguna
        foreach ($this->selectedOptions as $kriteriaId => $kriteriaDetailId) {
            InputPengguna::create([
                'log_pengguna_id' => $this->pengguna->id,
                'kriteria_detail_id' => $kriteriaDetailId,
                ''
            ]);
        }

        // $matchingRules = $this->findMatchingRules($this->pengguna->id);

        // Hitung similarity
        $this->similarityResults = $this->calculateSimilarity($this->pengguna->id);

        // Ambil similarity dengan skor tertinggi
        $this->highestSimilarity = collect($this->similarityResults)->sortByDesc('similarity')->first();

        // Simpan similarityResult tertinggi ke dalam sesi flash
        session()->flash('highestSimilarity', $this->highestSimilarity);

        // Redirect ke halaman baru
        redirect()->route('hasil');
    }
}; ?>

<div class="mb-8">
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
</div>
