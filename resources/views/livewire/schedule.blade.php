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
        @if($schedule->pause)
        <div class="my-4 py-2 w-full text-lg font-bold text-center border-t-2 border-b-2">{{Str::limit($schedule->time, 5, '')}}h {{$schedule->talk?->name}}</div>
        @else
        <div class="my-1 px-1 w-full sm:w-1/2 lg:my-4 lg:px-2 mb-6">
            <article
                class="flex flex-col justify-between overflow-hidden rounded-lg shadow-md h-full bg-white px-4 py-2">
                <div>
                    <h1 class="text-lg">
                        <div class="text-black font-bold sm:line-clamp-1 hover:line-clamp-none">
                            {{$schedule->talk?->name}}</div>
                        <div class="text-gray-700"><span
                                class="text-gray-500 font-bold">{{Str::limit($schedule->time, 5, '')}}h</span>
                            {{$schedule->room?->title}}</div>
                    </h1>
                    @if($schedule->talk?->description)
                    <div class="text-black py-2  mt-2">
                        @if(!empty($schedule->talk?->logo))
                        <img class="h-20 float-left sm:float-none lg:float-left mr-4 sm:mb-4" src="/storage/small/{{$schedule->talk->logo}}" />
                        @endif
                        <span class="sm:line-clamp-6 hover:line-clamp-none prose prose-tight leading-6">
                        {!!Str::markdown($schedule->talk->description)!!}
                        </span>
                    </div>
                    @endif
                </div>
                <div class="w-full flex flex-wrap items-center justify-end px-2 py-2">
                    @if(!empty($schedule->talk?->user))
                    <a href="/teilnehmerinnen/#{{$schedule->talk?->user->id}}"
                        class="flex items-center mb-2 rounded-full pr-3 h-10">
                        <img class="rounded-full float-left h-10 w-10" src="{{$schedule->talk->user->profilePhotoUrl}}" />
                        <span class="ml-2 text-sm">{{'@'.$schedule->talk->user->nickname}}</span>
                    </a>
                    @endif
                </div>


            </article>
        </div>
        @endif
        @endforeach
    </div>

</div>