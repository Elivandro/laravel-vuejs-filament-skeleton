<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])        
    </head>
    <body class="font-sans antialiased">
        <x-header-layout />

         <div class="min-h-screen flex flex-col mt-20 justify-center items-center px-4">
        
            <h1 class="text-4xl font-bold mb-6 text-center">
                🎉 Boilerplate Laravel Multi-Tenancy
            </h1>

            <p class="text-lg text-center max-w-2xl mb-8">
                Este projeto já vem preparado com uma estrutura completa para criar aplicações 
                multi-tenancy modernas usando Laravel.  
                Você pode utilizá-lo como base para novos sistemas, economizando tempo na configuração 
                e mantendo arquitetura profissional e escalável.
            </p>

            <div class="bg-white shadow-lg rounded-xl p-6 w-full max-w-2xl mb-10">
                <h2 class="text-2xl font-semibold mb-4">📦 O que vem incluso:</h2>

                <ul class="space-y-3 text-lg">
                    <li>✔ Estrutura completa de <a href="https://tenancyforlaravel.com/" target="_blank" class="underline font-bold">multi-tenancy</a> com múltiplos bancos ou schemas</li>
                    <li>✔ Separação entre <strong>área central</strong> e <strong>área dos tenants</strong></li>
                    <li>✔ Autenticação Laravel pronta para expansão</li>
                    <li>✔ Organização avançada de rotas para central/tenant</li>
                    <li>✔ Controllers, middleware e providers já configurados</li>
                    <li>✔ Pronto para uso com <a href="https://vuejs.org/" blank="_blank" class="font-bold underline">Vue</a>, <a href="https://filamentphp.com/" target="_blank" class="underline font-bold">Filament</a> ou <a href="https://livewire.laravel.com/docs/3.x/quickstart" target="_blank" class="underline font-bold">Livewire</a></li>
                    <li>✔ Estrutura para criação rápida de domínios e subdomínios</li>
                </ul>
            </div>

            <div class="bg-white shadow-md rounded-xl p-6 w-full max-w-2xl">
                <h2 class="text-2xl font-semibold mb-4">🚀 Como começar:</h2>
                <ol class="space-y-3 text-lg list-decimal pl-6">
                    <li>
                        Configure o domínio central no arquivo <code>.env</code>.
                    </li>
                    <li>
                        Rode as migrations e seeds iniciais para registrar seu primeiro tenant.
                    </li>
                    <li>
                        Acesse o painel central para gerenciar tenants, domínios e usuários.
                    </li>
                    <li>
                        Comece a desenvolver o módulo do tenant conforme necessidade do projeto futuro.
                    </li>
                </ol>
            </div>

            <livewire:list-tenants />

        </div>

        <x-footer-layout />
    </body>
</html>
