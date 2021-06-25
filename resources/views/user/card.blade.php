<article class="overflow-hidden rounded-lg shadow-md h-full">
    <img src="{{$user->profile_photo_url}}" class="block h-auto w-full" />
    <header class="flex items-center justify-between leading-tight px-2 md:px-4 py-2">
        <h1 class="text-lg">
            <span class="text-gray-900">{{$user->name}} ({{$user->nickname}})</span>
        </h1>
    </header>
</article>
