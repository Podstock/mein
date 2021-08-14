<ul x-init="$watch('messages', messages => {document.querySelectorAll('.chat').forEach(c => { c.scrollTop = c.scrollHeight})})"
    class="chat flex-1 divide-y divide-gray-200 overflow-y-auto">

    @foreach ($room_messages as $message)

    <li>
        <div class="relative group py-4 px-5 flex items-center">
            <div class="absolute inset-0 group-hover:bg-gray-50" aria-hidden="true"></div>
            <div class="flex-1 flex items-top min-w-0 relative">
                <span class="flex-shrink-0 inline-block relative">
                    <img class="h-10 w-10 rounded-full" src="{{$message->user?->ProfilePhotoUrl}}"
                        alt="{{$message->user?->name}}">
                </span>
                <div class="ml-4">
                    <p class="text-xs font-medium text-gray-900 truncate">
                        {{$message?->created_at?->format('d.m.Y H:i:s')}}
                    </p>

                    <p class="text-sm font-medium text-gray-900 truncate">
                        {{$message->user?->name}}
                        <span class="text-gray-500">{{'@'.$message->user?->nickname}}</span>
                    </p>
                    <p>
                        {!! Str::markdown($message->body) !!}
                    </p>
                </div>
            </div>

        </div>
    </li>
    @endforeach
    <template x-for="message in messages">
        <li>
            <div class="relative group py-4 px-5 flex items-center">
                <div class="absolute inset-0 group-hover:bg-gray-50" aria-hidden="true"></div>
                <div class="flex-1 flex items-top min-w-0 relative">
                    <span class="flex-shrink-0 inline-block relative">
                        <img class="h-10 w-10 rounded-full" :src="message.user.profile_photo_url"
                            :alt="message.user.name">
                    </span>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            <span x-text="message.user.name"></span>
                            <span x-html="'@'+message.user.nickname" class="text-gray-500"></span></p>
                        <p x-html="message.body"></p>
                    </div>
                </div>
            </div>
        </li>
    </template>
</ul>


<!-- add -->
<div x-data="" class="bg-gray-50 px-4 py-6 sm:px-6">
    <div class="flex space-x-3">
        <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="{{auth()->user()->profilePhotoUrl}}" alt="">
        </div>
        <div class="min-w-0 flex-1">
            <form action="#" wire:submit.prevent="send">
                <div>
                    <label for="comment" class="sr-only">About</label>
                    <textarea wire:model.defer="body" id="comment" name="body" rows="2"
                        x-on:keydown.enter="$event.shiftKey ? '' : $refs.submit.click()"
                        class="shadow-sm block w-full focus:ring-green-600 focus:border-green-600 sm:text-sm border border-gray-300 rounded-md"
                        placeholder="Add a comment"></textarea>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <span class="group inline-flex items-start text-sm space-x-2 text-gray-500 hover:text-gray-900">
                        <span>
                            You can use markdown
                        </span>
                    </span>
                    <button type="submit" x-ref="submit"
                        class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Comment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
