<x-layout>
    <section class="max-w-lg flex flex-col basis-full items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
        <h1 class="text-3xl font-semibold">Bem-vind@ de Volta!</h1>

        <form method="POST" action="{{ route('entrar') }}" class="w-full flex flex-col gap-y-6">
            @csrf
            <x-form-field label="Email" type="email" name="email" :value="old('email')" required/>
            <x-form-field label="Senha" type="password" name="password" required/>
            <x-primary-button>Entrar</x-primary-button>
        </form>

        <x-primary-link href="{{ route('cadastro') }}" class="text-sm">Não tem cadastro?</x-primary-link>
    </section>
</x-layout>
