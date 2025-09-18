<x-layouts.app>

    <div class="flex h-full justify-center">
        <div class="w-full max-w-[600px] bg-gray-100 flex justify-center items-center px-4">
            <div class="w-full max-w-[400px] flex flex-col items-center gap-8">
      
                <div class="w-full flex flex-col items-center gap-4">
                    <img src="{{ asset('assets/icon-facilita.svg') }}" alt="">
                    <div class="flex flex-col gap-2 items-center">
                        <h1 class="text-3xl md:text-4xl font-semibold text-center text-gray-800">Redefina a sua senha</h1>
                        <p class="text-base text-center text-gray-800">Redefina sua senha para acessar o sistema.</p>
                    </div>
                </div>

                <x-form action="{{ route('user.reset-password', $user) }}" class="w-full flex flex-col gap-4 items-center" put>
                    <input type="hidden" name="current_password" value="{{ $user->password }}">
                    <x-form.input-text type="password" name="new_password" placeholder="Nova senha" oninput="checkPasswordSteps(event)"/>
                    <x-password-requirements />
                    <x-form.input-text type="password" name="new_password_confirmation" placeholder="Confirme sua nova senha"/>
                    <x-action tag="button" type="submit" variant="secondary">Fazer login</x-action>
                </x-form>

            </div>
        </div>
    </div>

</x-layouts.app>


<script src="{{ asset('js/auth/login/reset-password.js') }}"></script>