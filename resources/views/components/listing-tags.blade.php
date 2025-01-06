@props(['listingData'])

<ul class="flex">
    @foreach ($listingData as $tag)
        <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
            {{ $tag->name }}
        </li>
    @endforeach
</ul>