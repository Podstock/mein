<div class="fixed inset-x-0 bottom-0">
    <div class="bg-gray-600 h-20">
        <div class="mx-auto py-1 px-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center space-x-8 sm:space-x-16">
                <div>
                    <div class="inline-flex relative">
                        <button wire:click="raiseHand()" type="button"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white block px-2 py-2 text-base font-medium rounded-md">
                            <svg class="h-9 w-9 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11">
                                </path>
                            </svg>
                            <!-- <div class="text-gray-300 text-sm text-center">Hand</div> -->
                        </button>
                        <span>
                            <button type="button"
                                class="block rounded-md px-1 py-2 h-14 text-sm font-medium text-gray-300 hover:bg-gray-700 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                                id="option-menu-button" aria-expanded="true" aria-haspopup="true">
                                <span class="sr-only">Open options</span>
                                <!-- Heroicon name: solid/chevron-down -->
                                <svg class="h-6 w-6 rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div class="hidden absolute right-0 -mt-32 w-14 ring-opacity-5 focus:outline-none" role="menu"
                                aria-orientation="vertical" aria-labelledby="option-menu-button" tabindex="-1">
                                <div class="flex space-x-2">
                                    <button type="button"
                                        class="text-gray-500 bg-gray-200 hover:bg-gray-700 hover:text-white group block px-2 py-2 text-base font-medium rounded-md">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="heart"
                                            class="h-9 w-9 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M462.3 62.71c-54.5-46.5-136.1-38.99-186.6 13.27l-19.69 20.61l-19.71-20.61C195.6 33.85 113.3 8.71 49.76 62.71C-13.11 116.2-16.31 212.5 39.81 270.5l193.2 199.7C239.3 476.7 247.8 480 255.9 480c8.25 0 16.33-3.25 22.58-9.751l193.6-199.8C528.5 212.5 525.1 116.2 462.3 62.71zM449.3 248.2l-192.9 199.9L62.76 248.2C24.39 208.7 16.39 133.2 70.51 87.09C125.3 40.21 189.8 74.22 213.3 98.59l42.75 44.13l42.75-44.13c23.13-24 88.13-58 142.8-11.5C495.5 133.1 487.6 208.6 449.3 248.2z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button type="button"
                                        class="text-gray-500 bg-gray-200 hover:bg-gray-700 hover:text-white group block px-2 py-2 text-base font-medium rounded-md">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fal"
                                            data-icon="hand-horns" class="h-9 w-9 mx-auto" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                d="M360 64c-30.88 0-56 25.12-56 56v61.62C296.7 178.1 288.6 176 280 176c-12.16 0-23.35 4.002-32.54 10.62C237.6 170.7 220.1 160 200 160C191.4 160 183.3 162.1 176 165.6V56C176 25.12 150.9 0 120 0S64 25.12 64 56v210.2C36.07 273.5 16 298.9 16 328v64c0 19.89 9 38.3 24.72 50.52l46.03 35.81C114.7 500 149.6 512 184.9 512H264c83.81 0 152-68.19 152-152v-240C416 89.13 390.9 64 360 64zM280 208c13.22 0 24 10.77 24 24v96c0 13.23-10.78 24-24 24S256 341.2 256 328v-96C256 218.8 266.8 208 280 208zM200 192C213.2 192 224 202.8 224 216v32.99C214.3 243.3 203.1 240.1 191.5 240.1c-4.243 0-8.548 .4312-12.87 1.334L176 241.1V216C176 202.8 186.8 192 200 192zM120 32C133.2 32 144 42.77 144 56v192.8L96 259.1V56C96 42.77 106.8 32 120 32zM384 360c0 66.17-53.84 120-120 120H184.9c-28.28 0-56.19-9.562-78.56-26.94l-46.03-35.8C52.63 411.3 48 401.8 48 392v-64c0-15 10.62-28.16 25.28-31.3l111.9-23.98c2.195-.4532 4.387-.6713 6.55-.6713c15.81 0 32.23 12.47 32.23 31.99c0 14.75-10.29 28.04-25.28 31.26l-74.06 15.86c-7.528 1.603-12.67 8.24-12.67 15.63c0 9.602 8.066 16.03 16 16.03c1.112 0 2.236-.1205 3.355-.3713l74.06-15.86c9.676-2.076 18.22-6.408 25.56-12.1C240.5 371.1 258.8 384 280 384c30.88 0 56-25.12 56-56v-96c0-1.824-.3672-3.547-.5391-5.326C335.6 225.8 336 224.9 336 224V120C336 106.8 346.8 96 360 96S384 106.8 384 120V360z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
                <div x-data="stream_webrtc">
                    <button type="button" @click="toggle_listen" :class="isListening ? 'text-red-400' : 'text-gray-300'"
                        class="hover:bg-gray-700 group items-center px-2 py-2 text-base font-medium rounded-md block">
                        <svg class="hidden h-12 w-12 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                clip-rule="evenodd" />
                        </svg>

                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="headset"
                            class="h-12 w-12 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M191.1 224c0-17.72-14.34-32.04-32-32.04L144 192c-35.34 0-64 28.66-64 64.08v47.79C80 339.3 108.7 368 144 368H160c17.66 0 32-14.36 32-32.06L191.1 224zM256 0C112.9 0 4.583 119.1 .0208 256L0 296C0 309.3 10.75 320 23.1 320S48 309.3 48 296V256c0-114.7 93.34-207.8 208-207.8C370.7 48.2 464 141.3 464 256v144c0 22.09-17.91 40-40 40h-110.7C305 425.7 289.7 416 272 416H241.8c-23.21 0-44.5 15.69-48.87 38.49C187 485.2 210.4 512 239.1 512H272c17.72 0 33.03-9.711 41.34-24H424c48.6 0 88-39.4 88-88V256C507.4 119.1 399.1 0 256 0zM368 368c35.34 0 64-28.7 64-64.13V256.1C432 220.7 403.3 192 368 192l-16 0c-17.66 0-32 14.34-32 32.04L320 335.9C320 353.7 334.3 368 352 368H368z">
                            </path>
                        </svg>
                        <!-- <div class="text-gray-300 text-sm text-center">Join as listener</div> -->
                    </button>
                </div>
                <div>
                    <button wire:click="$emit('toggleChat')" type="button" title="Chat/Rooms"
                        class="{{ $chat ? 'bg-gray-700' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group block px-2 py-2 text-base font-medium rounded-md">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="screen-users"
                            class="h-9 w-9 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="currentColor"
                                d="M96 64h448v160c24.62 0 47 9.625 64 25V49.63c0-27.38-21.5-49.63-48-49.63h-480c-26.5 0-48 22.25-48 49.63v199.4c17-15.38 39.38-25 64-25V64zM256.2 320c0 35.26 28.57 63.85 63.79 63.98C355.2 383.8 383.8 355.3 383.8 320S355.2 256.2 320 256C284.8 256.2 256.2 284.7 256.2 320zM343.8 416h-47.5C256.4 416 224 449.5 224 490.7C224 502.4 233.3 512 244.8 512h150.3C406.7 512 416 502.4 416 490.7C416 449.5 383.6 416 343.8 416zM567.8 416h-47.5C480.4 416 448 449.5 448 490.7C448 502.4 457.3 512 468.8 512h150.3C630.7 512 640 502.4 640 490.7C640 449.5 607.6 416 567.8 416zM480.2 320c0 35.26 28.57 63.85 63.79 63.98C579.2 383.8 607.8 355.3 607.8 320S579.2 256.2 544 256C508.8 256.2 480.2 284.7 480.2 320zM32.21 320c0 35.26 28.57 63.85 63.79 63.98C131.2 383.8 159.8 355.3 159.8 320S131.2 256.2 96 256C60.78 256.2 32.21 284.7 32.21 320zM119.8 416h-47.5C32.42 416 0 449.5 0 490.7C0 502.4 9.34 512 20.83 512h150.3C182.7 512 192 502.4 192 490.7C192 449.5 159.6 416 119.8 416z">
                            </path>
                        </svg>
                        {{-- <div class="text-gray-300 text-sm text-center">Chat</div> --}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
