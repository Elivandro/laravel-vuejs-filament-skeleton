<template>
    <section class="max-w-5xl mx-auto px-6">

        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-green-600 mb-4">
                Plataforma Multi-Tenant
            </h1>

            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Uma base moderna para criação de aplicações SaaS utilizando
                Laravel, VueJS e arquitetura multi-tenant via API.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-10 mb-16">
            <div class="bg-gray-50 p-4 text-center rounded-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                    Sobre a aplicação
                </h2>

                <p class="text-gray-600 leading-relaxed">
                    Este projeto foi desenvolvido como uma base reutilizável
                    para aplicações SaaS multi-tenant, onde cada tenant possui
                    seus próprios dados, domínio e usuários.
                </p>

                <p class="text-gray-600 leading-relaxed mt-4">
                    O backend é totalmente desacoplado do frontend, expondo
                    uma API segura que identifica automaticamente o tenant
                    através do domínio ou subdomínio.
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h2 class="text-center text-2xl font-semibold text-gray-800 mb-4">
                    Tecnologias utilizadas
                </h2>

                <ul class="space-y-3 text-gray-600">
                    <li>✅ Laravel como backend e API</li>
                    <li>✅ Vue.js para interface frontend</li>
                    <li>✅ Filament para painel administrativo</li>
                    <li>✅ Tenancy for Laravel em modo API</li>
                    <li>✅ Arquitetura multi-tenant por domínio</li>
                </ul>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg shadow p-4 mb-16">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                Como funciona o multi-tenant
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Cada tenant é identificado automaticamente pelo domínio ou
                subdomínio da requisição. A partir disso, todas as consultas
                feitas à API são isoladas e retornam apenas dados pertencentes
                ao tenant atual.
            </p>

            <p class="text-gray-600 leading-relaxed mt-4">
                O frontend em VueJS consome a API normalmente, sem precisar
                enviar manualmente o identificador do tenant — a resolução é
                feita no backend.
            </p>
        </div>

        <div class="text-center">
            <p class="text-gray-600 mb-6">
                Este projeto serve como ponto de partida para novos produtos,
                economizando tempo e padronizando boas práticas.
            </p>

            <span class="inline-block bg-green-500 text-white px-6 py-3 rounded-lg">
                Pronto para evoluir 🚀
            </span>
        </div>

    </section>
</template>

<script>
export default {
    name: 'AboutApp',
};
</script>
