<x-layouts.auth>
    {{-- Passagem para o Facilita RH (RP21): MigrationNoticeMiddleware. --}}
    <div class="h-screen w-full max-w-[640px] sm:h-fit sm:rounded-2xl" style="box-shadow: 0px 0px 36px 24px #5ec8bc50">
        <div class="bg-secondary-background border-borders flex h-full w-full flex-col items-center justify-center gap-6 overflow-auto border px-6 py-8 text-center shadow-sm sm:h-fit sm:justify-start sm:rounded-2xl">
            <h2 class="font-heading text-main-text text-xl font-semibold">Os Riscos Psicossociais mudaram de endereço</h2>

            <p class="font-text text-main-text text-sm leading-6">
                @if ($isCompany)
                    A sua empresa agora usa os Riscos Psicossociais dentro do <strong>Facilita RH</strong>, com todas as campanhas, resultados e o plano de ação que estavam aqui. Entre pelo Facilita RH com o acesso da empresa.
                @else
                    As pesquisas da sua empresa agora são respondidas pelo <strong>Facilita Conecta</strong>, no celular ou no computador. Entre com o seu CPF e a sua senha do Conecta.
                @endif
            </p>

            <p class="font-text text-secondary-text text-sm">
                Este endereço deixa de funcionar para a sua empresa em
                <strong class="text-main-text">{{ $daysLeft }} {{ $daysLeft === 1 ? 'dia' : 'dias' }}</strong>
                ({{ $deadline->format('d/m/Y') }}).
            </p>

            <a href="{{ $target }}" class="bg-primary-solid font-heading text-main-background w-full rounded-lg px-4 py-3 text-sm font-semibold transition hover:scale-[1.02]">
                {{ $isCompany ? 'Ir para o Facilita RH' : 'Ir para o Facilita Conecta' }}
            </a>
        </div>
    </div>
</x-layouts.auth>
