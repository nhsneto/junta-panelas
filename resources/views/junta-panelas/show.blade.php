<x-layout>
    <div class="mt-5 max-w-2xl flex flex-col basis-full gap-y-14">
        <div class="space-y-4">
            <div class="flex items-center justify-center gap-x-2">
                <h1 class="text-2xl font-bold">{{ $juntaPanelas->title }}</h1>
                <form method="GET" action="">
                    <button class="flex px-1 py-1 rounded hover:bg-black/5 hover:text-[#d3756b] active:bg-black/10">
                        <x-icons.download-document/>
                    </button>
                </form>
            </div>
            <p class="text-md text-center font-bold text-black/50">{{ date('d/m/Y · H:i', strtotime($juntaPanelas->date)) }}</p>
        </div>

        <table>
            <caption class="mb-10 text-base font-bold">{{ __('Participants') }}</caption>
            @foreach($juntaPanelas->participants->sortBy('name') as $participant)
                <tr class="flex justify-between px-3 py-1 font-semibold rounded odd:bg-black/5">
                    <td>{{ $participant->name }}</td>
                    <td>{{ implode(' · ', $participant->items) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</x-layout>
