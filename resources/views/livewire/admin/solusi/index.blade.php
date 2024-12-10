<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\Solusi;
use Livewire\Attributes\Rule;

new class extends Component {
    use Toast;
    public bool $createModal = false;

    #[Rule('required')]
    public string $kode = '';

    #[Rule('required')]
    public int $total_skor_resiko;

    #[Rule('required')]
    public string $kategori_resiko = '';

    #[Rule('required')]
    public string $deskripsi = '';

    public function headers(): array
    {
        return [
            ['key' => 'kode', 'label' => 'Kode'],
            ['key' => 'total_skor_resiko', 'label' => 'Skor'],
            ['key' => 'kategori_resiko', 'label' => 'Kategori'],
            // ['key' => 'deskripsi', 'label' => 'Rekomendasi', 'class' => 'prose']
        ];
    }

    public function with(): array
    {
        return [
            'solusi' => Solusi::all(),
            'headers' => $this->headers(),
        ];
    }

    public function save():void
    {
        $data = $this->validate();
        Solusi::create($data);

        $this->createModal = false;
        $this->resetField();
        $this->success('Kriteria berhasil ditambah');
    }
}; ?>

<div>
    <x-header title="Solusi" separator progress-indicator>
        <x-slot:actions>
            <x-button label="Tambah" link="/solusi/create" responsive icon="o-plus" class="btn-primary" />
            {{-- <x-theme-toggle darkTheme="synthwave" lightTheme="cupcake" /> --}}
        </x-slot:actions>
    </x-header>

    <x-card shadow>
        <x-table :headers="$headers" :rows="$solusi" link="solusi/{id}/edit" class="text-base">
            @scope('actions', $solusi)
                <x-button icon="o-trash" wire:click="delete({{ $solusi['id'] }})" wire:confirm="Are you sure?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>

    <x-modal wire:model="createModal" title="Tambah Solusi" persistent separator class="w-full">
        @php
            $option = [
                ['id' => 'Rendah', 'name' => 'Rendah'],
                ['id' => 'Sedang', 'name' => 'Sedang'],
                ['id' => 'Tinggi', 'name' => 'Tinggi'],
                ['id' => 'Sangat Tinggi', 'name' => 'Sangat Tinggi'],
            ];
        @endphp
        <x-form wire:submit="save">
            <div class="flex flex-col lg:flex-row gap-4">
                <x-input label="Kode" wire:model="kode"/>
                <x-input label="Skor" wire:model="total_skor_resiko" type="number"/>
            </div>
            <x-select label="Kategori Resiko" icon="o-user" :options="$option" wire:model="kategori_resiko" />

            <x-editor wire:model="deskripsi" label="Rekomendasi" />

            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.createModal = false" />
                <x-button label="Submit" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-modal>
</div>
