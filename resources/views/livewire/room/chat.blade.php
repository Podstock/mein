<div x-data="{messages: []}" @message.window="messages.push($event.detail.msg)" x-show="$wire.show" x-cloak
    x-init="document.querySelectorAll('.chat').forEach(c => { c.scrollTop = c.scrollHeight})"
    @resize.window="document.querySelectorAll('.chat').forEach(c => { c.scrollTop = c.scrollHeight})">

    <div class="hidden md:flex w-screen max-w-sm xl:max-w-md"></div>
    <div class="overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="fixed inset-y-0 right-0 pl-4 max-w-full flex sm:pl-16">
            <div class="w-screen max-w-sm xl:max-w-md"
                x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                <div class="h-full flex flex-col bg-white shadow-xl overflow-y-scroll">
                    <div class="p-4">
                        <div class="flex items-start justify-between">
                            <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                                Room xyz
                            </h2>
                            <div class="ml-3 h-4 flex items-center">
                                <button wire:click="$emit('toggleChat')"
                                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close panel</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-200">
                        <div class="px-6">
                            <nav class="-mb-px flex space-x-4">
                                <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                                <a href="#"
                                    class="border-green-700 text-green-700 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">Chat</a>

                                <a href="#"
                                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">Als nächstes</a>

                                <a href="#"
                                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">Andere Räume</a>
                            </nav>
                        </div>
                    </div>
                    @include('room.messages')
                    <div class="h-20 bg-gray-600"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
        Echo.private("chat.{{$room->id}}")
            .listen('MessageAdded', (e) => {
                var event = new CustomEvent("message", {
                    detail: {msg: e.message},
                });
                window.dispatchEvent(event);
            });
    });
    </script>
</div>
