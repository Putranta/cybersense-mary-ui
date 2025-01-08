<?php

use Livewire\Volt\Component;
use App\Models\Article;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public function headers(): array
    {
        return [
            ['key' => 'img', 'label' => 'Img'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'category', 'label' => 'Category'],
        ];
    }


    public function with(): array
    {
        return [
            'articles' => Article::all(),
            'headers' => $this->headers(),
        ];
    }

    public function delete(Article $article): void
    {
        $article->delete();
        $this->warning("$article->name deleted", position: 'toast-bottom');
    }
}; ?>

<div>
    <x-header title="Article" separator progress-indicator >
        <x-slot:actions>
            <x-button label="Tambah" link="/admin/article/create"  responsive icon="o-plus" class="btn-primary" />
            {{-- <x-theme-toggle darkTheme="synthwave" lightTheme="cupcake" /> --}}
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$articles"  class="text-base">
            @scope('cell_img', $article)
            <x-avatar image="{{ $article->img ?? '/empty-user.jpg' }}" class="!w-14 !rounded-lg" />
            @endscope
            @scope('cell_category', $article)
                @foreach ($article->categories as $item)
                    <x-badge value="{{$item->name}}" class="badge-primary" />
                @endforeach
            @endscope
            @scope('actions', $article)
                <x-button icon="o-trash" wire:click="delete({{ $article['id'] }})" wire:confirm="Are you sure?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>
</div>
