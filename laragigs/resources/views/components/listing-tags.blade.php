@props(['tagsCsv'])

@php
    $tags = unserialize($tagsCsv);
    $tags[4] = 'new_value';
    $updatedTagsSerialized = serialize($tags);


@endphp

    
<ul class="flex">
    @foreach($tags as $tag)
        <li
            class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
        >
        {{-- this will assist in filtering of the tags --}}
            <a href="/?tag={{ $tag }}">{{ $tag }}</a>
        </li>
    @endforeach
    
</ul>