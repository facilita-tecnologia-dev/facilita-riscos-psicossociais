<x-layouts.auth>
    <div class="flex h-full justify-center">
        <div class="flex w-full max-w-[600px] items-center justify-center bg-gray-100 px-4">
            <div class="flex w-full max-w-[400px] flex-col items-center gap-8">
                <div class="flex w-full flex-col items-center gap-4">
                    <img src="{{ asset('assets/icon-facilita.svg') }}" alt="" />
                    <div class="flex flex-col items-center gap-2">
                        <h1 class="text-center text-3xl font-semibold text-gray-800 md:text-4xl">Escolha a empresa</h1>
                        <p class="text-center text-base text-gray-800">Escolha em qual das empresas você quer fazer login</p>
                    </div>
                </div>

                <div class="flex max-h-64 w-full flex-col gap-2 overflow-auto px-2 py-2">
                    @foreach ($user->companies as $company)
                        <x-form action="{{ route('user.login.login-with-company', ['user' => $user, 'company' => $company]) }}" post>
                            <button type="submit" class="relative top-0 left-0 block w-full cursor-pointer rounded-md border border-gray-200 bg-gray-100/50 px-2 py-3 text-center shadow-md transition-all hover:-top-0.5 hover:left-0.5">
                                {{ $company->name }}
                            </button>
                        </x-form>
                    @endforeach
                </div>

                <x-action href="{{ route('logout') }}" variant="secondary">Voltar</x-action>
            </div>
        </div>
    </div>
</x-layouts.auth>
