<x-page-layout>
    <div class="max-w-screen-sm mx-auto p-5">
        @if($tent->user)
        @foreach($tent->user?->projects as $project)
        <div class="mb-4">
            <a href="{{$project->url}}">
                <h2 class="text-3xl border-b mb-3 pb-1">{{$project->name}}</h2>
                <div class="prose lg:prose-xl">
                    <img src="/storage/tiny/{{$project->logo}}" />
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</x-page-layout>
