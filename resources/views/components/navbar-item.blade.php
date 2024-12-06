@props(['url', 'active' => false])

@php
    $classes = ($active == false)? 'group' : 'group active'
@endphp

<a href="{{$url}}" wire:navigate {{ $attributes->merge(['class'=>$classes])}}>
    {{ $slot }}
</a>
