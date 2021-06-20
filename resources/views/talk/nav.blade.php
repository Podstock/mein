<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="sm:block">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 h-12" aria-label="Tabs">
                <x-jet-nav-link href="{{ route('mytalks') }}" :active="request()->routeIs('mytalks')">
                    {{ __('Meine Einreichungen') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('submission') }}" :active="request()->routeIs('submission')">
                    {{ __('Neue Einreichung') }}
                </x-jet-nav-link>
            </nav>
        </div>
    </div>
</div>
