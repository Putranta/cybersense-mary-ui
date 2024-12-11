<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Rule;
use App\Models\RuleBase;
use App\Models\KriteriaDetail;

new class extends Component {
    use Toast;
    public RuleBase $ruleBase;
    public bool $createModal = false;
    public array $kriteriaDetail = [];

    public int $kriteria_detail_id = 0;

    #[Rule('required|min:3')]
    public array $kriteria_detail = [];

    #[Rule('required')]
    public string $kode = '';

    #[Rule('required')]
    public int $skor;

    #[Rule('required')]
    public string $kategori = '';

    public function headers():array
    {
        return [
            ['key' => 'kode', 'label' => 'Kode'],
            ['key' => 'kriteria', 'label' => 'Kriteria', 'class' => 'hidden lg:table-cell'],
            ['key' => 'skor', 'label' => 'Skor'],
            ['key' => 'kategori', 'label' => 'Kategori']
        ];
    }

    public function save():void
    {
        $data = $this->validate();
        $data['pemilik_case'] = 'Pakar';
        $this->ruleBase = RuleBase::create($data);

        // Sync selection
        $this->ruleBase->kriteriaDetails()->sync($this->kriteria_detail);

        $this->createModal = false;
        $this->reset(['kode', 'skor', 'kategori', 'kriteria_detail']);
        $this->success('Rule Base berhasil ditambah');
    }

    public function mount()
    {
        $this->kriteriaDetail = KriteriaDetail::with('kriteria')->get()->map(function ($detail) {
            return [
                'id' => $detail->id,
                'label' => $detail->kode,
                'sub_label' => "{$detail->kriteria->name} : {$detail->name}"
            ];
        })->toArray();
    }

    public function with():array
    {
        return [
            'rule' => RuleBase::all(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="Rule Base" separator progress-indicator >
        <x-slot:actions>
            <x-button label="Tambah" @click="$wire.createModal = true" responsive icon="o-plus" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <x-card >
        <x-table :headers="$headers" :rows="$rule" link="kriteria/{id}/detail" class="text-base">
            @scope('cell_kriteria', $rule)
                @foreach ($rule->kriteriaDetails as $item)
                    <x-badge value="{{$item->kode}}" class="badge-primary" />
                @endforeach
            @endscope
            @scope('actions', $rule)
                <x-button icon="o-trash" wire:click="delete({{ $rule['id'] }})" wire:confirm="Are you sure?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>

    <x-modal wire:model="createModal" title="Tambah Rule Base" separator>
        @php
            $option = [
                ['id' => 'Rendah', 'name' => 'Rendah'],
                ['id' => 'Sedang', 'name' => 'Sedang'],
                ['id' => 'Tinggi', 'name' => 'Tinggi'],
                ['id' => 'Sangat Tinggi', 'name' => 'Sangat Tinggi'],
            ];
        @endphp
        <x-form wire:submit="save">

            <div class="flex flex-col lg:flex-row gap-3 mb-6">
                <div class="basis-1/4">
                    <x-input label="Kode" wire:model="kode" />
                </div>
                <div class="basis-1/4">
                    <x-input label="Skor" wire:model="skor" type="number" />
                </div>
               <div class="basis-1/2">
                <x-select label="Kategori" icon="o-user" :options="$option" wire:model="kategori" placeholder="-- Pilih --"  />
               </div>
            </div>
            <x-choices-offline
            label="Detail Kriteria"
            wire:model="kriteria_detail"
            :options="$kriteriaDetail"
            option-label="label"
            option-sub-label="sub_label"
            searchable />
            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.createModal = false" />
                <x-button label="Submit" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-modal>
</div>
