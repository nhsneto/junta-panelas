<x-layout>
    <section class="max-w-lg flex flex-col basis-full items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
        <h1 class="text-3xl font-semibold">Cadastro</h1>

        <form method="POST" action="/cadastro" class="w-full flex flex-col gap-y-6">
            @csrf
            <x-form-field label="Nome" name="name" :value="old('name')" required/>
            <x-form-field label="Email" type="email" name="email" :value="old('email')" required/>
            <x-form-field label="Senha" type="password" name="password" required/>
            <x-form-field label="Confirmar Senha" type="password" name="password_confirmation" required/>
            <x-primary-button>Cadastrar</x-primary-button>
        </form>

        <x-primary-link class="text-sm">Já tem cadastro?</x-primary-link>
    </section>
</x-layout>
