<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Rule;
use App\Models\RuleBase;
use App\Models\KriteriaDetail;

new class extends Component {
    use Toast;

    public int $kriteria_detail_id = 0;

    #[Rule('required')]
    public array $kriteriaDetail = [];

    public function headers():array
    {
        return [
            ['key' => 'kode', 'label' => 'Kode'],
            ['key' => 'kriteria', 'label' => 'Kriteria', 'class' => 'hidden lg:table-cell'],
        ];
    }


    public function with():array
    {
        return [
            'rule' => RuleBase::all(),
            'kriteriaDetail' => KriteriaDetail::all(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="Rule Base" separator progress-indicator >
        <x-slot:actions>
            <x-button label="Tambah" link="/rule-base/create" responsive icon="o-plus" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <x-card>
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
</div>
