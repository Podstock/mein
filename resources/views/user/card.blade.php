<x-empty-layout>
    <div class="space-y-3">
        <img class="mx-auto h-32 w-32 rounded-full" src="{{$avatar}}" aria-hidden="true">
        <div class="text-center">
            <div class="font-medium text-lg leading-6 space-y-1">
                <h3 class="text-gray-800">{{$user->name}}</h3>
                <p class="text-green-800">{{$user->nickname}}</p>
            </div>

            <ul class="flex justify-center space-x-5 mt-2">
                <li>
                    @if (!empty($user->twitter))
                    <a href="https://twitter.com/{{$user->twitter}}" class="text-gray-500 hover:text-gray-400" target="_blank">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path
                                d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84">
                            </path>
                        </svg>
                    </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</x-empty-layout>
