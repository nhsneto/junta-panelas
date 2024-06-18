<article class="group flex flex-col basis-full gap-y-2 px-6 py-3 bg-[#fbfbfb] rounded-lg shadow-md">
    <div class="flex justify-between gap-x-2">
        <h2 class="font-bold text-black/50">Nelson</h2>
        <form method="POST" action="">
            @csrf
            <button class="hidden px-1 py-1 rounded hover:bg-black/5 active:bg-black/10 hover:text-[#c82333] group-hover:flex">
                <x-icons.trash />
            </button>
        </form>
    </div>
    <p class="text-sm font-semibold text-black/50">Brigadeiro · Coca-cola</p>
</article>
