<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\Article;
use Livewire\Attributes\Rule;
use App\Models\Category;
use Livewire\WithFileUploads;

new class extends Component {
    use Toast, WithFileUploads;
    public Article $article;

    #[Rule('required')]
    public string $title = '';

    #[Rule('required|image|max:2048')]
    public $img;

    #[Rule('required')]
    public array $category = [];

    #[Rule('required')]
    public ?string $content =null;

    public function with(): array
    {
        return [
            'categories' => Category::All(),
        ];
    }

    public function save(): void
    {
        $data = $this->validate();
        $data['slug'] = Str::slug($data['title']);

        $this->article = Article::create($data);

        // Sync selection
        $this->article->categories()->sync($this->category);

        // Upload file and save the avatar `url` on User model
        if ($this->img) {
            $url = $this->img->store('article', 'public');
            $this->article->update(['img' => "/storage/$url"]);
        }
        $this->success('Article Successfully Created', redirectTo: '/admin/article');
    }

}; ?>

<div>
    <x-header title="Create Article" separator progress-indicator />

    <x-form wire:submit="save">

            <x-input label="Title" wire:model="title" class="mb-3" />
            <x-editor wire:model="content" label="Content"  class="mb-3" />
            <x-choices-offline label="Categories" wire:model="category" :options="$categories" class="mb-3" />
            <x-file label="Image" wire:model='img' accept='image/png, image/jpg, image/jpeg'>
                <img src="{{ $article->img ?? '/blank_img.jpg' }}" alt="" class="h-40 rounded-lg">
            </x-file>


        <x-slot:actions>
            <x-button label="Cancel" link="/admin/article" />
            <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-form>
</div>
