<?php

use Livewire\Volt\Component;
use App\Models\Category;
use Mary\Traits\Toast;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;

new class extends Component {
    use Toast;

    #[Rule('required')]
    public string $name = '';

    public bool $createModal = false;

    public function headers(): array
    {
        return [['key' => 'name', 'label' => 'name'], ['key' => 'slug', 'label' => 'slug']];
    }

    public function with(): array
    {
        return [
            'categories' => Category::all(),
            'headers' => $this->headers(),
        ];
    }

    public function resetField()
    {
        $this->name = "";
    }

    public function save():void
    {
        $data = $this->validate();
        $data['slug'] = Str::slug($data['name']);
        Category::create($data);

        $this->createModal = false;
        $this->resetField();
        $this->success('Category berhasil ditambah');
    }

    public function delete(Category $category): void
    {
        $category->delete();
        $this->warning("$category->name deleted", '', position: 'toast-bottom');
    }
}; ?>

<div>
    <x-header title="Category" separator progress-indicator >
        <x-slot:actions>
            <x-button label="Tambah" @click="$wire.createModal = true" responsive icon="o-plus" class="btn-primary" />
            {{-- <x-theme-toggle darkTheme="synthwave" lightTheme="cupcake" /> --}}
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$categories"  class="text-base">
            @scope('actions', $category)
                <x-button icon="o-trash" wire:click="delete({{ $category['id'] }})" wire:confirm="Are you sure?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>

    <x-modal wire:model="createModal" title="Tambah Category" separator>
        <x-form wire:submit="save">
            <x-input label="Category Name" wire:model="name"/>

            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.createModal = false" />
                <x-button label="Submit" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-modal>
</div>
