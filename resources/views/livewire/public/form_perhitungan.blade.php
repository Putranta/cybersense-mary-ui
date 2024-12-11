<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\LogPengguna;
use App\Models\Kriteria;

new
#[Layout('components.layouts.public')]
class extends Component {
    public LogPengguna $pengguna;
    public array $selectedOptions = [];

    public function mount($id) {
        $this->pengguna = LogPengguna::findOrFail($id);
    }

    public function with():array
    {
        return [
            'kriteria' => Kriteria::with('kriteriaDetails')->get(),
        ];
    }
}; ?>

<div>
    <div class="md:w-2/3 mx-auto mt-10">
        <x-card title="Form Perhitungan" subtitle="Pilih Sesuai dengan kondisi UMKM kamu sekarang" shadow separator>
            @foreach ($kriteria as $item)
                <x-card title="{{$item['name']}}">
                    <x-radio
                        :options="$item['kriteriaDetails']"
                        wire:model="selectedOptions.{{ $item['id'] }}"
                    />

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
        </x-card>
    </div>
</div>
