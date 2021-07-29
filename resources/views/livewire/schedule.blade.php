<div class="container mx-auto">
    <h2 class="text-lg font-bold">Fahrplan</h2>
    <ul class="list-reset flex flex-wrap mt-5 mb-4 justify-center">
        <li class="mr-3">
            <a href="/fahrplan" @class(['p-2 rounded-lg', 'bg-green-700 text-white'=> $day === 1])>Fr, 13.08.</a>
        </li>
        <li class="mr-3">
            <a href="/fahrplan?day=2" @class(['p-2 rounded-lg', 'bg-green-700 text-white'=> $day === 2])>Sa, 14.08.</a>
        </li>
        <li class="mr-3">
            <a href="/fahrplan?day=3" @class(['p-2 rounded-lg', 'bg-green-700 text-white'=> $day === 3])>So, 15.08.</a>
        </li>
    </ul>

    <div class="flex flex-wrap -mx-1 lg:-mx-4">

        @foreach ($schedules as $schedule)
        <div class="my-1 px-1 w-full sm:w-1/2 lg:my-4 lg:px-2 mb-6">
            <article
                class="overflow-hidden rounded-lg shadow-md h-full bg-white px-4 py-2">
                <header class="pb-2">
                    <h1 class="text-lg">
                        <div class="text-black font-bold">{{Str::limit($schedule->time, 5, '')}}
                            {{$schedule->talk?->name}}</div>
                        <div class="text-gray-700">{{$schedule->room?->title}}</div>
                    </h1>
                </header>
                @if($schedule->talk?->description)
                <div class="text-black py-2">
                    @if(!empty($schedule->talk?->logo))
                    <img class="h-20 float-left mr-4" src="/storage/small/{{$schedule->talk->logo}}" />
                    @endif

                    {!!Str::markdown($schedule->talk->description)!!}
                </div>
                @endif
                <div class="w-full flex flex-wrap items-center justify-end px-2 py-2">
                    @if(!empty($schedule->talk?->user))
                    <a href="/teilnehmerinnen/#{{$schedule->talk?->user->id}}"
                        class="flex items-center mb-2 rounded-full pr-3 h-10">
                        <img class="rounded-full float-left h-full" src="{{$schedule->talk->user->profilePhotoUrl}}" />
                        <span class="ml-2 text-sm">{{'@'.$schedule->talk->user->nickname}}</span>
                    </a>
                    @endif
                </div>

                <footer class="flex justify-between content-end">
                </footer>
            </article>
        </div>
        @endforeach
    </div>

</div>
