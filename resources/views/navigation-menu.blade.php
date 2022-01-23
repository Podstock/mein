<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-signs"
                            class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M507.31 84.69L464 41.37c-6-6-14.14-9.37-22.63-9.37H288V16c0-8.84-7.16-16-16-16h-32c-8.84 0-16 7.16-16 16v16H56c-13.25 0-24 10.75-24 24v80c0 13.25 10.75 24 24 24h385.37c8.49 0 16.62-3.37 22.63-9.37l43.31-43.31c6.25-6.26 6.25-16.38 0-22.63zM224 496c0 8.84 7.16 16 16 16h32c8.84 0 16-7.16 16-16V384h-64v112zm232-272H288v-32h-64v32H70.63c-8.49 0-16.62 3.37-22.63 9.37L4.69 276.69c-6.25 6.25-6.25 16.38 0 22.63L48 342.63c6 6 14.14 9.37 22.63 9.37H456c13.25 0 24-10.75 24-24v-80c0-13.25-10.75-24-24-24z">
                            </path>
                        </svg>
                        <span>{{ __('Wegweiser') }}</span>
		    </x-jet-nav-link>
{{--
                    <x-jet-nav-link href="{{ route('camping') }}" :active="request()->routeIs('camping')">

                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="campground"
                            class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="currentColor"
                                d="M624 448h-24.68L359.54 117.75l53.41-73.55c5.19-7.15 3.61-17.16-3.54-22.35l-25.9-18.79c-7.15-5.19-17.15-3.61-22.35 3.55L320 63.3 278.83 6.6c-5.19-7.15-15.2-8.74-22.35-3.55l-25.88 18.8c-7.15 5.19-8.74 15.2-3.54 22.35l53.41 73.55L40.68 448H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h608c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM320 288l116.36 160H203.64L320 288z">
                            </path>
                        </svg>
                        <span>{{ __('Zelten') }}</span>
		    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('mytalks') }}" :active="request()->is('talks/*')">

                        <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="signal-stream"
                            class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <g class="fa-group">
                                <path class="fa-secondary" fill="currentColor"
                                    d="M198.27 168.37l-22.76-22.23a16.44 16.44 0 0 0-24 1.31 168.77 168.77 0 0 0 0 217.1 16.44 16.44 0 0 0 24 1.31l22.76-22.22a15.12 15.12 0 0 0 1.45-20.32 107.39 107.39 0 0 1 0-134.64 15.11 15.11 0 0 0-1.45-20.31zm226.19-20.92a16.44 16.44 0 0 0-24-1.31l-22.76 22.23a15.12 15.12 0 0 0-1.45 20.31 107.39 107.39 0 0 1 0 134.64 15.14 15.14 0 0 0 1.45 20.32l22.76 22.22a16.44 16.44 0 0 0 24-1.31 168.77 168.77 0 0 0 0-217.1z"
                                    opacity="0.4"></path>
                                <path class="fa-primary" fill="currentColor"
                                    d="M288 200a56 56 0 1 0 56 56 56 56 0 0 0-56-56zM64 256a214.3 214.3 0 0 1 55.42-144.06c5.59-6.22 4.91-15.74-1.08-21.59L96 68.53a16.41 16.41 0 0 0-23.56 1C25.59 121 0 186.56 0 256s25.59 135 72.44 186.52a16.41 16.41 0 0 0 23.56 1l22.34-21.82c6-5.85 6.67-15.37 1.08-21.59A214.3 214.3 0 0 1 64 256zM503.56 69.48a16.41 16.41 0 0 0-23.56-1l-22.34 21.87c-6 5.85-6.67 15.37-1.08 21.59a214.95 214.95 0 0 1 0 288.12c-5.59 6.22-4.91 15.74 1.08 21.59L480 443.47a16.41 16.41 0 0 0 23.56-1C550.41 391 576 325.44 576 256s-25.59-135-72.44-186.52z">
                                </path>
                            </g>
                        </svg>
                        <span>{{ __('Call for Podcasts') }}</span>
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('merch') }}" :active="request()->routeIs('merch')">

                        <svg class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="file-image" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path fill="currentColor"
                                d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z">
                            </path>
                        </svg>
                        <span>{{ __('Sticker') }}</span>
                    </x-jet-nav-link>
--}}
                    <x-jet-nav-link href="{{ route('fahrplan') }}" :active="request()->routeIs('fahrplan')">
                        <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="rocket-launch" class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M52.05 154.5L2.65 253.2C1.15 256.6 .225 260.3 .1 264c0 13.25 10.8 24 24.05 24h85.17c46.64-79.44 72.15-124.5 87.53-151.5C198.4 133.7 199.6 130.8 201.2 128H94.92C78.55 128 59.3 139.9 52.05 154.5zM375.5 314.9c-26.92 15.39-71.95 40.95-151.5 87.76L224 488c0 13.25 10.75 24 23.1 24c3.75-.125 7.375-1.05 10.75-2.55l98.69-49.38c14.62-7.375 26.5-26.45 26.5-42.83l0-106.7C381.2 312.1 378.3 313.3 375.5 314.9zM35.62 352.1c-25.75 25.75-38.62 90.5-34.1 159.3c69.12 3.625 133.6-9.375 159.4-35.13c40.25-40.25 42.87-93.87 6.25-130.5C129.6 309.3 75.1 311.8 35.62 352.1zM117.4 436.1c-8.625 8.5-30.12 12.88-53.12 11.62c-1.25-22.88 2.1-44.5 11.62-53c13.5-13.5 31.37-14.38 43.5-2.125C131.6 404.8 130.7 422.6 117.4 436.1z"></path><path class="fa-primary" fill="currentColor" d="M505.2 19.66c-1.228-5.684-7.273-11.71-12.96-12.91C460.4 0 435.4 0 410.4 0C332.1 0 278.8 31.08 237 77.31C209.6 107.7 222.6 95.06 109.3 288c63.29 0 114.7 51.32 114.7 114.6c192.9-113.5 180.1-100.4 210.5-127.9c46.21-41.8 77.44-95.99 77.44-172.1C512.1 76.64 512.1 51.53 505.2 19.66zM383.1 168c-22 0-39.1-17.88-39.1-40s18.06-40 40.06-40C406.2 88 423.1 105.9 423.1 128S406.1 168 383.1 168zM75.87 394.8c-8.625 8.5-12.87 30.12-11.62 53c22.1 1.25 44.5-3.125 53.12-11.62c13.37-13.5 14.25-31.38 1.1-43.5C107.2 380.4 89.37 381.3 75.87 394.8z"></path></g></svg>
                        <span>{{ __('Fahrplan') }}</span>
                    </x-jet-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                                @endforeach
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Wegweiser') }}
	    </x-jet-responsive-nav-link>
{{--
            <x-jet-responsive-nav-link href="{{ route('camping') }}" :active="request()->routeIs('camping')">
                {{ __('Zelten') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('mytalks') }}" :active="request()->is('talks/*')">
                {{ __('Call for Podcasts') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('merch') }}" :active="request()->routeIs('merch')">
                {{ __('Merch/Sticker') }}
	    </x-jet-responsive-nav-link>
--}}
            <x-jet-responsive-nav-link href="{{ route('fahrplan') }}" :active="request()->routeIs('fahrplan')">
                {{ __('Fahrplan') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="flex-shrink-0 mr-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                    :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                    :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-jet-responsive-nav-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                    :active="request()->routeIs('teams.create')">
                    {{ __('Create New Team') }}
                </x-jet-responsive-nav-link>
                @endcan

                <div class="border-t border-gray-200"></div>

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
