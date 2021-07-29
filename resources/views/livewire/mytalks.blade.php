<div>
    @if($talks->isEmpty())
    <div class="mx-auto space-y-6 mt-8">
        <div class="flex justify-center">Keine Einreichungen vorhanden</div>
        <div class="flex justify-center">
            <x-action-link class="flex items-center justify-center" href="{{ route('submission') }}">Etwas einreichen
            </x-action-link>
        </div>
    </div>
    @else
    <div class="flex flex-col mt-8 mx-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name im Programm
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Art
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Geplant
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($talks as $talk)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            @if($talk->logo)
                                            <img class="h-12 w-12 rounded-full" src="/storage/small/{{$talk->logo}}"
                                                alt="">
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$talk->name}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$talk->TypeName}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span @class(['px-2 inline-flex text-xs leading-5 font-semibold
                                        rounded-full', 'bg-blue-100 text-blue-800'=> (int)$talk->status ===
                                        $talk::STATUS_SUBMITTED,
                                        'bg-yellow-100 text-yellow-800'=> (int)$talk->status ===
                                        $talk::STATUS_ACCEPTED,
                                        'bg-green-100 text-green-800'=> (int)$talk->status ===
                                        $talk::STATUS_CONFIRMED],
                                        )>
                                        {{$talk::getStatus((int)$talk->status)}}
                                    </span>
                                </td>
                                <td>
                                    @if($talk->schedule && (int)$talk->status >= $talk::STATUS_ACCEPTED)
                                    {{$talk->schedule::getDay($talk->schedule->day)}} -
                                    {{Str::limit($talk->schedule->time, 5, 'h')}}
                                    <br />
                                    @if((int)$talk->status !== $talk::STATUS_CONFIRMED)
                                    <button wire:click="confirm({{$talk->id}})" type="button"
                                        class="text-yellow-700 hover:text-yellow-900">Jetzt Bestätigen</button>
                                    @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('submission.edit', $talk->id) }}"
                                        class="text-green-700 hover:text-green-900">Bearbeiten</a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 text-xs border-t pt-4">
                    <ul class="space-y-3">
                        <li>
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Eingereicht
                            </span>
                            Wird vom Orga Team aktuell geprüft, du bekommst eine Nachricht sobald wir deine Einreichung
                            angenommen haben.
                        </li>
                        <li>
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Angenommen
                            </span>
                            Wir haben deine Einreichung angenommen. Du musst diese nun noch bestätigen.
                        </li>
                        <li>
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Bestätigt
                            </span>
                            Du hast deine Einrichung bestätigt und diese ist öffentlich im Programm sichtbar.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    @endif
</div>
