<footer class="m-auto w-full max-w-[1280px] space-y-6 px-3 pt-[80px] pb-8 md:px-6 md:pt-[110px]">
    <div class="border-secondary-text flex flex-col items-start justify-between gap-12 border-b pb-12 lg:flex-row lg:gap-4">
        <img src="{{ asset('assets/logo-facilita.webp') }}" class="h-15 object-scale-down" alt="Logomarca Facilita Tecnologia" />

        <div class="flex flex-col items-start gap-8 md:flex-row md:gap-20 xl:gap-28">
            <div class="space-y-6 sm:space-y-7 md:space-y-8">
                <h3 class="text-main-text font-heading text-left text-lg font-semibold">Sistema</h3>
                <nav class="space-y-4 sm:space-y-5 md:space-y-6">
                    <a class="text-main-text font-text hover:text-primary-solid block cursor-pointer text-left text-base font-normal transition" onclick="{{ request()->routeIs('site.home') ? 'scrollToY(event, \'hero-section\')' : null }}" href="{{ request()->routeIs('site.home') ? null : route('site.home') }}">Início</a>
                    <a class="text-main-text font-text hover:text-primary-solid block cursor-pointer text-left text-base font-normal transition" onclick="{{ request()->routeIs('site.home') ? 'scrollToY(event, \'how-it-works\', 112)' : null }}" href="{{ request()->routeIs('site.home') ? null : route('site.home') }}">Como funciona</a>
                    <a class="text-main-text font-text hover:text-primary-solid block cursor-pointer text-left text-base font-normal transition" onclick="{{ request()->routeIs('site.home') ? 'scrollToY(event, \'system-resources\', 112)' : null }}" href="{{ request()->routeIs('site.home') ? null : route('site.home') }}">Recursos</a>
                </nav>
            </div>

            <div class="space-y-6 sm:space-y-7 md:space-y-8">
                <h3 class="text-main-text font-heading text-left text-lg font-semibold">Termos e Política</h3>
                <nav class="space-y-4 sm:space-y-5 md:space-y-6">
                    <a class="text-main-text font-text hover:text-primary-solid block cursor-pointer text-left text-base font-normal transition" href="{{ route('site.privacy-policy') }}">Política de Privacidade</a>
                    <a class="text-main-text font-text hover:text-primary-solid block cursor-pointer text-left text-base font-normal transition" href="{{ route('site.terms-of-use') }}">Termos de uso</a>
                </nav>
            </div>

            <div class="space-y-6 sm:space-y-7 md:space-y-8">
                <h3 class="text-main-text font-heading text-left text-lg font-semibold">Contato</h3>
                <nav class="space-y-4 sm:space-y-5 md:space-y-6">
                    <a class="text-main-text font-text hover:text-primary-solid block cursor-pointer text-left text-base font-normal transition" href="mailto:{{ config('app.facilita-contact-email') }}">{{ config('app.facilita-contact-email') }}</a>
                    <a class="text-main-text font-text hover:text-primary-solid block cursor-pointer text-left text-base font-normal transition">{{ config('app.facilita-contact-landline') }}</a>
                    <a class="text-main-text font-text hover:text-primary-solid block cursor-pointer text-left text-base font-normal transition" href="{{ config('app.facilita-whatsapp-phone-1-url') }}">{{ config('app.facilita-whatsapp-phone-1') }}</a>
                    <a class="text-main-text font-text hover:text-primary-solid block cursor-pointer text-left text-base font-normal transition" href="{{ config('app.facilita-whatsapp-phone-2-url') }}">{{ config('app.facilita-whatsapp-phone-2') }}</a>
                </nav>
            </div>
        </div>
    </div>

    <div class="text-center">
        <span class="text-main-text font-text text-center text-base font-normal">Todos os direitos reservados &copy; 2025 Facilita Tecnologia</span>
    </div>
</footer>
