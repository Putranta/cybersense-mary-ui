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

    #[Rule('required|unique:kriteria,kode')]
    public string $kode = '';

    #[Rule('required')]
    public float $bobot;

    public bool $createModal = false;


    public function headers(): array
    {
        return [
            ['key' => 'kode', 'label' => 'Kode'],
            ['key' => 'name', 'label' => 'Nama'],
            ['key' => 'detail', 'label' => 'Detail', 'class' => 'hidden lg:table-cell'],
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
        $this->kode = "";
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

    public function delete(Kriteria $kriteria): void
    {
        $kriteria->delete();
        $this->warning("$kriteria->name deleted", '', position: 'toast-bottom');
    }
}; ?>

<div>
    <x-header title="Kriteria" separator progress-indicator >
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
            @scope('actions', $kriteria)
                <x-button icon="o-trash" wire:click="delete({{ $kriteria['id'] }})" wire:confirm="Are you sure?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>

    <x-modal wire:model="createModal" title="Tambah Kriteria" separator>
        <x-form wire:submit="save">
            <x-input label="Kriteria" wire:model="name"/>

            <div class="flex flex-row gap-3 mb-3">
                <x-input label="Bobot" wire:model="bobot"/>
                <x-input label="Kode" wire:model="kode" />
            </div>

            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.createModal = false" />
                <x-button label="Submit" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-modal>


</div>
