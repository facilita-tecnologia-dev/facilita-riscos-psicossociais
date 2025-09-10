<x-layouts.site>
    <main>
        <section class="m-auto flex w-full max-w-[1180px] flex-col items-center gap-16 px-3 pt-[132px] sm:px-6 md:pt-[152px]">
            <h1 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl">Termos de uso</h1>

            <div class="flex items-start gap-8 lg:gap-12">
                <div class="sticky top-[140px] hidden w-[200px] flex-shrink-0 flex-col gap-2 md:flex xl:w-[280px]">
                    <button onclick="scrollToY(event, 'acceptance-of-terms', 150)" class="text-secondary-text font-text hover:text-main-text cursor-pointer py-1.5 text-left text-sm font-normal transition lg:text-base">Aceitação dos Termos</button>
                    <button onclick="scrollToY(event, 'service-description', 150)" class="text-secondary-text font-text hover:text-main-text cursor-pointer py-1.5 text-left text-sm font-normal transition lg:text-base">Descrição do serviço</button>
                    <button onclick="scrollToY(event, 'user-responsibilities', 150)" class="text-secondary-text font-text hover:text-main-text cursor-pointer py-1.5 text-left text-sm font-normal transition lg:text-base">Responsabilidades do usuário</button>
                    <button onclick="scrollToY(event, 'permitted-use', 150)" class="text-secondary-text font-text hover:text-main-text cursor-pointer py-1.5 text-left text-sm font-normal transition lg:text-base">Uso permitido</button>
                    <button onclick="scrollToY(event, 'intellectual-property', 150)" class="text-secondary-text font-text hover:text-main-text cursor-pointer py-1.5 text-left text-sm font-normal transition lg:text-base">Propriedade intelectual</button>
                    <button onclick="scrollToY(event, 'changes-to-terms', 150)" class="text-secondary-text font-text hover:text-main-text cursor-pointer py-1.5 text-left text-sm font-normal transition lg:text-base">Alterações nos Termos</button>
                    <button onclick="scrollToY(event, 'termination', 150)" class="text-secondary-text font-text hover:text-main-text cursor-pointer py-1.5 text-left text-sm font-normal transition lg:text-base">Rescisão</button>
                </div>
                <div class="flex flex-1 flex-col gap-8 md:gap-10 lg:gap-12">
                    <div id="acceptance-of-terms" class="space-y-4 md:space-y-6">
                        <h2 class="text-main-text font-heading text-center text-lg font-semibold md:text-xl">Aceitação dos Termos</h2>
                        <p class="text-main-text font-text text-justify indent-8 text-sm leading-7 font-normal md:text-base">
                            Ao utilizar Facilita Canal de Denúncias , você concorda com estes Termos de Uso, bem como com nossa
                            <a href="{{ route('site.privacy-policy') }}" class="font-bold hover:underline">Política de Privacidade</a>
                            .
                        </p>
                    </div>
                    <div id="service-description" class="space-y-4 md:space-y-6">
                        <h2 class="text-main-text font-heading text-center text-lg font-semibold md:text-xl">Descrição do serviço</h2>
                        <p class="text-main-text font-text text-justify indent-8 text-sm leading-7 font-normal md:text-base">O Facilita Canal de Denúncias é uma ferramenta simples e segura, projetada para garantir a integridade de todo o processo de denúncia e, quando necessário, assegurar o anonimato dos denunciantes. A plataforma oferece um ambiente completo para o acompanhamento e gerenciamento das denúncias, atendendo tanto às necessidades do denunciante quanto às do comitê de avaliação e da empresa.</p>
                    </div>
                    <div id="user-responsibilities" class="space-y-4 md:space-y-6">
                        <h2 class="text-main-text font-heading text-center text-lg font-semibold md:text-xl">Responsabilidades do usuário</h2>
                        <p class="text-main-text font-text text-justify indent-8 text-sm leading-7 font-normal md:text-base">O usuário é responsável por manter suas credenciais de acesso confidenciais, bem como por fornecer dados verdadeiros e atualizados durante a utilização do sistema.</p>
                    </div>
                    <div id="permitted-use" class="space-y-4 md:space-y-6">
                        <h2 class="text-main-text font-heading text-center text-lg font-semibold md:text-xl">Uso permitido</h2>
                        <p class="text-main-text font-text text-justify indent-8 text-sm leading-7 font-normal md:text-base">O uso do sistema deve ser pessoal, legal e em conformidade com as normas estabelecidas. É proibido utilizá-lo para fins ilícitos, prejudiciais ou que violem os direitos de terceiros.</p>
                    </div>
                    <div id="intellectual-property" class="space-y-4 md:space-y-6">
                        <h2 class="text-main-text font-heading text-center text-lg font-semibold md:text-xl">Propriedade intelectual</h2>
                        <p class="text-main-text font-text text-justify indent-8 text-sm leading-7 font-normal md:text-base">O sistema e todos os seus conteúdos são protegidos por direitos autorais. É vedado ao usuário copiar, reproduzir, distribuir ou modificar qualquer parte do sistema sem a devida autorização.</p>
                    </div>
                    <div id="changes-to-terms" class="space-y-4 md:space-y-6">
                        <h2 class="text-main-text font-heading text-center text-lg font-semibold md:text-xl">Alterações nos Termos</h2>
                        <p class="text-main-text font-text text-justify indent-8 text-sm leading-7 font-normal md:text-base">Reservamo-nos o direito de alterar os termos a qualquer momento. As alterações entrarão em vigor após a publicação no sistema e a devida comunicação ao usuário.</p>
                    </div>
                    <div id="termination" class="space-y-4 md:space-y-6">
                        <h2 class="text-main-text font-heading text-center text-lg font-semibold md:text-xl">Rescisão</h2>
                        <p class="text-main-text font-text text-justify indent-8 text-sm leading-7 font-normal md:text-base">Suspensão ou encerramento da conta em caso de violação dos termos.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layouts.site>
