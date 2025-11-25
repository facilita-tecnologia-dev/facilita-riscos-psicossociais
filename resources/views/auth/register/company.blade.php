<x-layouts.auth>
    <div class="flex h-full justify-center">
        <div class="flex w-full max-w-[600px] items-center justify-center bg-gray-100 px-4">
            <div class="flex w-full max-w-[400px] flex-col items-center gap-8">
                <div class="flex w-full flex-col items-center gap-4">
                    <img src="{{ asset('assets/icon-facilita.svg') }}" alt="" />
                    <div class="flex flex-col items-center gap-2">
                        <h1 class="text-center text-3xl font-semibold text-gray-800 md:text-4xl">Registre-se</h1>
                    </div>
                    <x-structure.text-content>Registre sua empresa no Facilita Riscos Psicossociais</x-structure.text-content>
                </div>

                <x-form action="{{ route('company.register') }}" class="flex w-full flex-col items-center gap-3" post>
                    <x-form.input-text name="name" placeholder="Razão Social" />
                    <x-form.input-text name="cnpj" placeholder="CNPJ (00.000.000/0000-00)" />
                    <x-form.input-text name="email" placeholder="E-mail" />
                    <x-form.input-text type="password" name="password" placeholder="Senha" oninput="checkPasswordSteps(event)" />
                    <x-password-requirements />
                    <x-form.input-text type="password" name="password_confirmation" placeholder="Confirme sua senha" />
                    <x-action tag="button" type="submit" width="full" variant="secondary">Registrar</x-action>
                </x-form>

                <a href="{{ route('site.home') }}" class="text-sm underline">Voltar para a Home</a>
            </div>
        </div>
    </div>
</x-layouts.auth>

<script src="{{ asset('js/auth/register/company.js') }}"></script>
