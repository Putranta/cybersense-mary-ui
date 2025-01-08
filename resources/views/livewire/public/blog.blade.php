<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Article;

new
#[Layout('components.layouts.public')]
class extends Component {
    public function with()
    {
        return [
            'articles' => Article::latest()->get(),
        ];
    }
}; ?>

<div>
    <div class="min-h-[100vh] overflow-hidden pb-40 pt-10 px-8">
        <h1 class="text-5xl font-bold text-center">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500">
                Blog
            </span>
        </h1>

        @foreach ($articles as $article)
        @php
            $content = $article->content; // Ambil konten artikel
            $plainText = strip_tags($content); // Hapus semua tag HTML
            $summary = Str::limit($plainText, 150);
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-3 py-10 md:px-12">
            <x-card class="shadow-lg">
                <a href="/blog/{{$article->slug}}" class="hover:text-pink-600 transition duration-300 mb-4" >
                    <h2 class="text-lg font-semibold">{{ $article->title }}</h2>
                </a>
                <p class="pt-4 text-sm text-opacity-50">
                    {{ $summary }}
                </p>

                <x-slot:figure >
                    <a href="/blog/{{$article->slug}}" class="w-full">
                        <img src="{{ $article->img }}" class="h-48 w-full object-cover overflow-hidden hover:scale-110 transition-all duration-500"/>
                    </a>
                </x-slot:figure>
            </x-card>
        </div>
        @endforeach
    </div>
</div>
