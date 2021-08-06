<div class="mt-6">
    <div class="max-w-7xl mx-auto px-4 text-center sm:px-6 lg:px-8">
        <div class="space-y-8 sm:space-y-10">
            <div class="space-y-5 sm:mx-auto sm:max-w-xl sm:space-y-4 lg:max-w-5xl">
                <h2 class="text-2xl font-extrabold tracking-tight">
                    Bühne
                </h2>
            </div>
            <ul
                class="mx-auto grid grid-cols-2 gap-x-4 gap-y-6 sm:grid-cols-3 lg:grid-cols-4 md:gap-x-6 lg:max-w-5xl lg:gap-x-8 lg:gap-y-12 xl:grid-cols-6">
                <template x-for="user in speakers()">
                    <li>
                        <div class="space-y-2">
                            <span class="inline-block relative">
                                <button @click="$wire.emit('modalUser', user.id)">
                                    <img :class="user.connected ? '' : 'opacity-30'"
                                        class="mx-auto h-20 w-20 rounded-full lg:w-24 lg:h-24" :src="user.image"
                                        alt="" />
                                </button>
                                <span x-show="user.hand" class="absolute -top-1 -right-1 rounded-lg text-gray-600">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="text-sm font-medium">
                                    <h3 x-text="user.name"></h3>
                                </div>
                            </div>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>
