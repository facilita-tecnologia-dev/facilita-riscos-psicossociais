<x-layouts.auth>
    <div class="flex h-full justify-center">
        <div class="flex w-full max-w-[600px] items-center justify-center bg-gray-100 px-4">
            <div class="flex w-full max-w-[400px] flex-col items-center gap-8">
                <div class="flex w-full flex-col items-center gap-4">
                    <img src="{{ asset('assets/icon-facilita.svg') }}" alt="" />
                    <div class="flex flex-col items-center gap-2">
                        <h1 class="text-center text-3xl font-semibold text-gray-800 md:text-4xl">Login</h1>
                        <p class="text-center text-base text-gray-800">Faça login como gestor ou colaborador.</p>
                    </div>
                </div>

                <x-form action="{{ route('user.login') }}" class="flex w-full flex-col items-center gap-4" post>
                    @if (session('message'))
                        <span class="text-success text-center text-sm">{{ session('message') }}</span>
                    @endif

                    <x-form.input-text name="cpf" placeholder="CPF (000.000.000-00)" />
                    <x-action tag="button" type="submit" variant="secondary" width="full">Fazer login</x-action>
                </x-form>

                <div class="flex w-full justify-between gap-2">
                    <a href="{{ route('site.home') }}" class="text-sm underline">Voltar para a Home</a>
                    <a href="{{ route('user.password.request') }}" class="text-sm underline">Esqueci minha senha</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
