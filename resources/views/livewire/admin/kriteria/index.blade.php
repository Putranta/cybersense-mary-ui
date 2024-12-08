<?php

use App\Models\Kriteria;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;

new class extends Component {
    use Toast;

    public string $search = '';

    public int $kriteria_detail_id = 0;

    #[Rule('required')]
    public string $name = '';

    #[Rule('required')]
    public float $bobot;

    public bool $createModal = false;


    public function headers(): array
    {
        return [
            ['key' => 'name', 'label' => 'Nama'],
            ['key' => 'detail', 'label' => 'Detail'],
            ['key' => 'bobot', 'label' => 'Bobot']
        ];
    }

    public function kriteria()
    {
        return Kriteria::query()
            ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
            ->when($this->kriteria_detail_id, fn(Builder $q) => $q->where('kriteria_detail_id', $this->kriteria_detail_id))
            ->get();
    }

    public function with(): array
    {
        return [
            'kriteria' => $this->kriteria(),
            'headers' => $this->headers(),
        ];
    }

    public function resetField()
    {
        $this->name = "";
        $this->bobot = 0.0;
    }

    public function save():void
    {
        $data = $this->validate();
        $data['slug'] = Str::slug($data['name']);
        Kriteria::create($data);

        $this->createModal = false;
        $this->resetField();
        $this->success('Kriteria berhasil ditambah');
    }
}; ?>

<div>
    <x-header title="Kriteria" separator progress-indicator @row-click="$wire.detailModal = true">
        <x-slot:actions>
            <x-button label="Tambah" @click="$wire.createModal = true" responsive icon="o-plus" class="btn-primary" />
            {{-- <x-theme-toggle darkTheme="synthwave" lightTheme="cupcake" /> --}}
        </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$kriteria" link="kriteria/{id}/detail" class="text-base">
            @scope('cell_detail', $kriteria)
                @foreach ($kriteria->kriteriaDetails as $item)
                    <x-badge value="{{$item->name}}" class="badge-primary" />
                @endforeach
            @endscope
        </x-table>
    </x-card>

    <x-modal wire:model="createModal" title="Tambah Kriteria" separator>
        <x-form wire:submit="save">
            <x-input label="Kriteria" wire:model="name"/>
            <x-input label="Bobot" wire:model="bobot"/>

            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.createModal = false" />
                <x-button label="Submit" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-modal>

    <x-modal wire:model="detailModal" title="Detail Kriteria" separator>

    </x-modal>
</div>
