<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Article;

new
#[Layout('components.layouts.public')]
class extends Component {
    public $article;

    public function mount($slug): void
    {
        $this->article = Article::where('slug', $slug)->first();

        if (!$this->article) {
            abort(404, 'Article not found');
        }
    }
}; ?>

<div class="flex justify-center">
    <div class="w-full md:w-3/4">
        <div class="min-h-[100vh] overflow-hidden pb-40 pt-10 px-4 md:mx-20">
            <x-card class="shadow-lg" title="{{ $article->title }}">
                <div class="pb-4">
                    @foreach ($article->categories as $item)
                        <x-badge value="{{$item->name}}" class="badge-secondary !py-3" />
                    @endforeach
                </div>
                <div class="prose">
                    {!! $article->content !!}
                </div>

                <x-slot:figure >
                     <img src="{{ $article->img }}" class="w-full" />
                </x-slot:figure>
            </x-card>
        </div>
    </div>
</div>
