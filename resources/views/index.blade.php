<x-layout>
    <section class="w-full flex justify-between items-center">
        <div class="max-w-md">
            <h1 class="text-5xl font-bold leading-tight">Planeje agora seu Junta-Panelas!</h1>
            <p class="mt-4 text-xl leading-snug">Quando será o junta-panelas? O que o pessoal vai levar?</p>
            <a href="{{ url('/entrar') }}" class="mt-4 block bg-[#f0997d] text-xl text-black/50 font-bold text-center py-4 rounded-xl drop-shadow-md hover:brightness-110 active:brightness-100">Planejar Agora</a>
        </div>
        <img src="{{ url('storage/pexels-fauxels-3184195-640.jpg') }}" alt="Pessoas almoçando em uma mesa" class="rounded-md drop-shadow-md">
    </section>
</x-layout>
