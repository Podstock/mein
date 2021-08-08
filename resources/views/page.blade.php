<x-page-layout>
    <div class="max-w-screen-sm mx-auto p-5">
        <h1 class="text-3xl border-b mb-3 pb-1">{{$page->title}}</h1>
        <div class="prose lg:prose-xl">
        {!!$page->body!!}
        </div>
    </div>
</x-page-layout>
