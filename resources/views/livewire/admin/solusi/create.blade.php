<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Livewire\WithFileUploads;
use App\Models\Solusi;
use Livewire\Attributes\Rule;

new class extends Component {
    use Toast, WithFileUploads;
    public bool $createModal = false;

    #[Rule('required')]
    public string $kode = '';

    #[Rule('required')]
    public int $total_skor_resiko;

    #[Rule('required')]
    public string $kategori_resiko = '';

    #[Rule('required')]
    public string $deskripsi = '';

    public function save():void
    {
        $data = $this->validate();
        Solusi::create($data);

        $this->resetField();
        $this->success('Solusi berhasil ditambah');
    }
}; ?>

<div>
    <x-header title="Tambah Solusi" separator progress-indicator />

    <x-card shadow>
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
            <x-select label="Kategori Resiko" icon="o-user" :options="$option" wire:model="kategori_resiko" />
        </div>

        <x-editor wire:model="deskripsi" label="Rekomendasi" />

        <x-slot:actions>
            <x-button label="Kembali" link="/solusi" />
            <x-button label="Submit" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-form>
    </x-card>
</div>
