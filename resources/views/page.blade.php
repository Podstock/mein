<x-empty-layout>
    <div class="max-w-screen-sm mx-auto p-5">
        <h1 class="text-3xl border-b mb-3 pb-1">{{$page->title}}</h1>
        <div id="page_body">
        {!!$page->body!!}
        </div>
    </div>
</x-empty-layout>
