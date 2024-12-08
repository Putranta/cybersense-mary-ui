<?php
namespace App\Http\Livewire\Admin\Kriteria;

use Livewire\Volt\Component;
use App\Models\Kriteria;
use App\Models\KriteriaDetail;
use Livewire\Attributes\Rule;

new class extends Component {
    public Kriteria $kriteria;

    #[Rule('required')]
    public string $name = '';

    public function mount(int $id): void
    {
        $this->kriteria = Kriteria::with('kriteriaDetails')->findOrFail($id);
    }

    public function saveDetail()
    {
        $count = $this->kriteria->kriteriaDetails->count();
        $data = $this->validate();
        $data['kriteria_id'] = $this->kriteria->id;
        $data['kode'] = 'K'.$this->kriteria->id.'.'.$count+1;

        KriteriaDetail::create($data);
        $this->name = '';
        $this->success('Detail Kriteria berhasil ditambah');
    }
}; ?>

<div>
    <x-header title="{{$kriteria->name}}" separator />

        <x-card>
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Nama: {{ $kriteria->name }}</h3>
            </div>
            <div class="mb-4">
                <p class="text-md">Bobot: {{ $kriteria->bobot }}</p>
            </div>
            <div class="mb-4">
                <p class="text-md">Slug: {{ $kriteria->slug }}</p>
            </div>
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Kriteria Detail :</h3>
                @forelse ($kriteria->kriteriaDetails as $item)
                    <x-list-item :item="$item" value="name" />
                @empty
                <p>Data tidak ditemukan.</p>
                @endforelse
                <x-form wire:submit="saveDetail" class="mt-6" class="w-full md:w-96">
                    <x-input wire:model="name" label="Tambah Detail Kriteria" inline />
                    <x-button label="Submit" icon="o-paper-airplane" spinner="saveDetail" type="submit" class="btn-primary" />
                </x-form>
            </div>
        </x-card>
</div>
