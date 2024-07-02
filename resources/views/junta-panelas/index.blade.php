<x-layout>
    <div class="mt-6 w-2/3 flex flex-col">
        <div id="stickyMenu" class="w-full mt-10 py-6 pl-8 sticky top-0 z-10 rounded-md bg-[#fbfbfb] drop-shadow">
            <x-primary-link-button href="{{ route('junta-panelas.create') }}" class="inline-block px-9 py-3">{{ __('Plan') }}</x-primary-link-button>
        </div>

        <div class="mt-5 overflow-x-auto rounded-md bg-[#fbfbfb] px-8 py-5 shadow">
            <table class="table table-lg table-pin-cols table-fixed">
                @foreach($juntaPanelasList as $juntaPanelas)
                    <tr class="group hover:bg-black/5 @if(count($juntaPanelasList) === 1) border-b-0 @endif">
                        <td class="py-10">
                            <x-primary-link href="{{ route('junta-panelas.show', ['juntaPanelas' => $juntaPanelas]) }}" class="text-lg font-bold">{{ $juntaPanelas->title }}</x-primary-link>
                        </td>

                        <td>
                            <x-date :date="$juntaPanelas->date" class="text-sm" />
                        </td>

                        <td>
                            <div class="hidden items-center gap-x-3 group-hover:flex">
                                <a href="{{ route('participant.index', ['juntaPanelas' => $juntaPanelas]) }}" title="{{ __('Participants') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                    <x-icons.people />
                                </a>
                                <button title="{{ __('Edit') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                    <x-icons.pencil />
                                </button>
                                <button title="{{ __('Delete') }}" class="px-1.5 py-1.5 rounded-full hover:bg-black/5 active:bg-black/10">
                                    <x-icons.trash />
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-layout>
