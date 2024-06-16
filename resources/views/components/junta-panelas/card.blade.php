<article {{ $attributes->merge(['class' => 'group bg-[#fbfbfb] px-5 py-4 rounded-xl shadow-md']) }}>
    <div class="flex gap-x-2 items-center">
        <h2 class="text-lg font-bold">Confraternização do Curso de Inglês</h2>
        <a href="{{ route('junta-panelas.edit') }}" class="hidden px-1 py-1 rounded-md group-hover:inline hover:bg-black/5 active:bg-black/10">
            <x-pencil-icon />
        </a>
    </div>

    <p class="mt-1 text-sm text-black/50 font-bold">31/05/2024 · 11:30</p>

    <div class="group/participants mt-4 inline-flex items-center gap-x-1.5">
        <x-people-icon class="group-hover/participants:text-[#d3756b]"/>
        <x-primary-link class="inline-block text-sm font-bold">{{ __('Participants') }}</x-primary-link>
    </div>
</article>
