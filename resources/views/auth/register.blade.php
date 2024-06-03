<x-layout>
    <section class="max-w-lg flex flex-col basis-full items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
        <h1 class="text-3xl font-semibold">Cadastro</h1>

        <form method="POST" action="/cadastro" class="w-full flex flex-col gap-y-6">
            @csrf
            <x-form-field label="Nome" name="nome" :value="old('nome')" required/>
            <x-form-field label="Email" type="email" name="email" :value="old('email')" required/>
            <x-form-field label="Senha" type="password" name="senha" required/>
            <x-form-field label="Confirmar Senha" type="password" name="senha_confirmation" required/>
            <button type="submit" class="bg-[#f0997d] text-xl text-black/50 font-bold text-center py-2.5 rounded-xl drop-shadow-md hover:brightness-110 active:brightness-100">Cadastrar</button>
        </form>

        <x-nav-link class="text-sm">Já tem cadastro?</x-nav-link>
    </section>
</x-layout>
