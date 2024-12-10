<?php

use App\Models\Kriteria;
use App\Models\KriteriaDetail;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Rule;

new class extends Component {
    use Toast;
    public Kriteria $kriteria;
    public $kriteriaDetail;

    public int $id;

    #[Rule('required')]
    public string $kriteria_name = '';

    #[Rule('required')]
    public string $kriteria_kode = '';

    #[Rule('required')]
    public string $kode = '';

    #[Rule('required')]
    public float $bobot;

    #[Rule('required')]
    public string $name = '';

    #[Rule('sometimes')]
    public ?string $rekomendasi = null;

    #[Rule('sometimes')]
    public ?string $desc = null;

    public string $update_name = '';
    public string $update_kode = '';

    public ?string $update_rekomendasi = null;

    public ?string $update_desc = null;

    public bool $createModal = false;
    public bool $updateModal = false;
    public $selectedRow;

    public function mount(int $id): void
    {
        $this->id = $id;
        $this->kriteria = Kriteria::with('kriteriaDetails')->findOrFail($id);
        // $this->kriteriaDetail = KriteriaDetail::where('kriteria_id', $id)->get();
        $this->kriteria_name = $this->kriteria->name;
        $this->bobot = $this->kriteria->bobot;
        $this->kriteria_kode = $this->kriteria->kode ?? '';
        $this->kriteriaDetail = $this->kriteria->kriteriaDetails;
    }

    public function headers(): array
    {
        return [['key' => 'name', 'label' => 'Nama'], ['key' => 'desc', 'label' => 'Deskripsi']];
    }

    public function with(): array
    {
        return [
            'headers' => $this->headers(),
        ];
    }

    public function delete(KriteriaDetail $kriteriaDetail): void
    {
        $kriteriaDetail->delete();
        $this->kriteriaDetail = $this->kriteria->kriteriaDetails;

        $this->warning("$kriteriaDetail->name deleted", '', position: 'toast-bottom');
    }

    public function updateKriteria(): void
    {
        $this->validate([
            'kriteria_name' => 'required',
            'kriteria_kode' => 'required|unique:kriteria,kode,' . $this->id,
            'bobot' => 'required',
        ]);

        $this->kriteria->update([
            'name' => $this->kriteria_name,
            'bobot' => $this->bobot,
            'kode' => $this->kriteria_kode,
        ]);

        $this->success('Kriteria berhasil diupdate');
    }

    public function saveDetail(): void
    {
        $this->kode = $this->kriteria->kode . '.' . $this->kode;
        $data = $this->validate([
            'name' => 'required',
            'kode' => 'required|unique:kriteria_detail,kode',
        ]);
        $data['kriteria_id'] = $this->kriteria->id;
        $data['desc'] = $this->desc;
        $data['rekomendasi'] = $this->rekomendasi;

        KriteriaDetail::create($data);
        $this->reset(['name', 'desc', 'rekomendasi', 'kode']);

        $this->kriteriaDetail = $this->kriteria->kriteriaDetails;
        $this->success('Detail Kriteria berhasil ditambah');
        $this->createModal = false;
    }

    public function edit($id)
    {
        $this->selectedRow = KriteriaDetail::find($id);
        $this->update_name = $this->selectedRow->name;
        $this->update_desc = $this->selectedRow->desc;
        $this->update_kode = $this->selectedRow->kode;
        $this->update_rekomendasi = $this->selectedRow->rekomendasi;
        $this->updateModal = true;
    }

    public function updateDetail()
    {
        $data = $this->validate([
            'update_name' => 'required',
            'update_kode' => 'required|unique:kriteria_detail,kode,' . $this->selectedRow->id,
        ]);

        $this->selectedRow->update([
            'name' => $this->update_name,
            'desc' => $this->update_desc,
            'rekomendasi' => $this->update_rekomendasi,
            'kode' => $this->update_kode
        ]);
        $this->kriteriaDetail = $this->kriteria->kriteriaDetails;
        $this->success('Detail Kriteria berhasil diupdate');
        $this->updateModal = false;
    }
}; ?>

<div>
    <x-header title="{{ $kriteria->name }}" separator />

    <x-card class="w-full lg:w-2/3 shadow mb-8">
        <x-form wire:submit="updateKriteria" class="w-full">
            <x-input wire:model="kriteria_name" label="Nama" />
            <div class="flex flex-row-2 gap-6 mb-4">
                <x-input wire:model="bobot" label="Bobot" type="number" min="0" max="1" step="any" />
                <x-input wire:model="kriteria_kode" label="Kode" />
            </div>
            <x-button label="Update" icon="o-paper-airplane" spinner="updateKriteria" type="submit"
                class="btn-primary" />
        </x-form>
    </x-card>

    <x-card class="w-full  shadow mb-8">
        <div class="mb-4">
            <h3 class="text-xl font-semibold">Kriteria Detail :</h3>
            @foreach ($kriteriaDetail as $item)
                <x-list-item :item="$item" separator hover>
                    <x-slot:avatar>
                        <x-badge value="{{$item->kode}}" class="badge-secondary" />
                    </x-slot:avatar>
                    <x-slot:value>
                        {{ $item->name }}
                    </x-slot:value>
                    <x-slot:sub-value>
                        @if ($item->desc != null)
                            <strong>Deskripsi :</strong> {{ $item->desc }} <br>
                        @endif

                        @if ($item->rekomendasi != null)
                            <strong>Rekomendasi :</strong> {{ $item->rekomendasi }}
                        @endif
                    </x-slot:sub-value>
                    <x-slot:actions>
                        <x-button icon="o-pencil" wire:click="edit({{ $item->id }})" spinner />
                        <x-button icon="o-trash" class="text-red-500" wire:click="delete({{ $item->id }})"
                            wire:confirm="Are you sure?" spinner />
                    </x-slot:actions>
                </x-list-item>
            @endforeach
        </div>
        <x-button label="Tambah" @click="$wire.createModal = true" responsive icon="o-plus" class="btn-primary" />
    </x-card>

    <x-modal wire:model="createModal" title="Tambah Detail Kriteria" separator>
        <x-form wire:submit="saveDetail">
            <div class="flex flex-row gap-3 mb-3">
                <div class="basis-2/3">
                    <x-input label="Nama" wire:model="name" />
                </div>

                <div class="basis-1/3">
                    <x-input label="Kode" wire:model="kode" prefix="{{ $kriteria_kode. '.'}}" type="number" />
                </div>

            </div>
            <x-textarea label="Deskripsi" wire:model="desc" hint="Max 1000 chars" rows="3" inline />

            <x-textarea label="Rekomendasi" wire:model="rekomendasi" hint="Max 1000 chars" rows="3" inline />

            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.createModal = false" />
                <x-button label="Submit" icon="o-paper-airplane" spinner="saveDetail" type="submit"
                    class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-modal>

    <x-modal wire:model="updateModal" title="Update Detail Kriteria" separator>
        <x-form wire:submit="updateDetail">
            <div class="flex flex-row gap-3 mb-3">
                <div class="basis-2/3">
                    <x-input label="Nama" wire:model="update_name" />
                </div>

                <div class="basis-1/3">
                    <x-input label="Kode" wire:model="update_kode" />
                </div>

            </div>
            <x-textarea label="Deskripsi" wire:model="update_desc" hint="Max 1000 chars" rows="3" inline />

            <x-textarea label="Rekomendasi" wire:model="update_rekomendasi" hint="Max 1000 chars" rows="3"
                inline />

            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.updateModal = false" />
                <x-button label="Submit" icon="o-paper-airplane" spinner="updateDetail" type="submit"
                    class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-modal>

</div>
