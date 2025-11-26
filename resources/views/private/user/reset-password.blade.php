<x-layouts.app>
    <div class="flex h-full justify-center">
        <div class="flex w-full max-w-[600px] items-center justify-center bg-gray-100 px-4">
            <div class="flex w-full max-w-[400px] flex-col items-center gap-8">
                <div class="flex w-full flex-col items-center gap-4">
                    <img src="{{ asset('assets/icon-facilita.svg') }}" alt="" />
                    <div class="flex flex-col items-center gap-2">
                        <h1 class="text-center text-3xl font-semibold text-gray-800 md:text-4xl">Redefina a sua senha</h1>
                        <p class="text-center text-base text-gray-800">Redefina sua senha para acessar o sistema.</p>
                    </div>
                </div>

                <x-form action="{{ route('user.reset-password', $user) }}" class="flex w-full flex-col items-center gap-4" put>
                    <input type="hidden" name="current_password" value="{{ $user->password }}" />
                    <x-form.input-text type="password" name="new_password" placeholder="Nova senha" oninput="checkPasswordSteps(event)" />
                    <x-password-requirements />
                    <x-form.input-text type="password" name="new_password_confirmation" placeholder="Confirme sua nova senha" />
                    <x-action tag="button" type="submit" variant="secondary">Fazer login</x-action>
                </x-form>
            </div>
        </div>
    </div>
</x-layouts.app>

<script src="{{ asset('js/auth/login/') }}"></script>
